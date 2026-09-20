<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\MatchModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $activePartnerId = $request->query('user_id');

        // Fetch user matches
        $matches = MatchModel::where('user1_id', $user->id)
            ->orWhere('user2_id', $user->id)
            ->get()
            ->map(function($m) use ($user) {
                return $m->user1_id === $user->id ? $m->user2_id : $m->user1_id;
            });

        // Also fetch any users with active message history
        $messagedUsers = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->get()
            ->map(function($msg) use ($user) {
                return $msg->sender_id === $user->id ? $msg->receiver_id : $msg->sender_id;
            });

        $allPartnerIds = collect($matches)->merge($messagedUsers)->unique()->filter(function($id) use ($user) {
            return $id != $user->id;
        })->values();

        // If specific user_id is requested (e.g. ?user_id=4), ensure it is included
        if ($activePartnerId && $activePartnerId != $user->id) {
            $allPartnerIds->prepend((int)$activePartnerId);
            $allPartnerIds = $allPartnerIds->unique()->values();
        }

        // If no conversations yet, provide top recommended verified daters (excluding self)
        if ($allPartnerIds->isEmpty()) {
            $allPartnerIds = User::where('id', '!=', $user->id)
                ->where('status', 'active')
                ->take(6)
                ->pluck('id');
        }

        $partners = User::whereIn('id', $allPartnerIds)->get();

        // Enrich partners with latest message and unread count
        $partners = $partners->map(function($p) use ($user) {
            $lastMsg = Message::where(function($q) use ($user, $p) {
                $q->where('sender_id', $user->id)->where('receiver_id', $p->id);
            })->orWhere(function($q) use ($user, $p) {
                $q->where('sender_id', $p->id)->where('receiver_id', $user->id);
            })->latest('id')->first();

            $unreadCount = Message::where('sender_id', $p->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', 0)
                ->count();

            $p->latest_message = $lastMsg;
            $p->unread_count = $unreadCount;
            return $p;
        });

        // Sort so activePartner or most recent is first
        if ($activePartnerId) {
            $partners = $partners->sortByDesc(function($p) use ($activePartnerId) {
                return $p->id == $activePartnerId ? 1 : 0;
            })->values();
        }

        $activePartner = null;
        if ($activePartnerId) {
            $activePartner = User::find($activePartnerId);
        } elseif ($partners->isNotEmpty()) {
            $activePartner = $partners->first();
        }

        // Ensure active partner is never self
        if ($activePartner && $activePartner->id === $user->id) {
            $activePartner = $partners->firstWhere('id', '!=', $user->id);
        }

        $messages = [];
        if ($activePartner) {
            $messages = Message::where(function($q) use ($user, $activePartner) {
                $q->where('sender_id', $user->id)->where('receiver_id', $activePartner->id);
            })->orWhere(function($q) use ($user, $activePartner) {
                $q->where('sender_id', $activePartner->id)->where('receiver_id', $user->id);
            })->orderBy('created_at', 'asc')->get();

            // Mark unread messages from activePartner as read
            Message::where('sender_id', $activePartner->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        }

        // Fetch new sparks/matches for horizontal carousel
        $sparks = User::where('id', '!=', $user->id)
            ->where('status', 'active')
            ->orderBy('is_verified', 'desc')
            ->take(8)
            ->get();

        return view('messages', compact('user', 'partners', 'activePartner', 'messages', 'sparks'));
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'receiver_id' => 'required|integer|exists:users,id',
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $receiver = User::whereKey($request->receiver_id)
            ->where('status', 'active')
            ->first();

        if (!$receiver) {
            return response()->json(['success' => false, 'message' => 'This member is no longer available.'], 422);
        }

        if ($receiver->id == $user->id) {
            return response()->json(['success' => false, 'message' => 'Cannot send messages to yourself.'], 422);
        }

        $messageText = trim($request->input('message', ''));
        $attachmentPath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'chat_' . $user->id . '_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $destDir = public_path('uploads/chat');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }
            $file->move($destDir, $filename);
            $attachmentPath = 'uploads/chat/' . $filename;
        }

        if (empty($messageText) && empty($attachmentPath)) {
            return response()->json(['success' => false, 'message' => 'Please enter a message or select a photo.'], 422);
        }

        try {
            $now = now();
            $cleanMessage = strip_tags($messageText);
            $payload = [
                'sender_id' => $user->id,
                'receiver_id' => $receiver->id,
                'is_read' => 0,
                'created_at' => $now,
            ];

            // Support installations upgraded from either historical chat schema.
            $columns = Schema::getColumnListing('messages');
            if (in_array('message', $columns, true)) {
                $payload['message'] = $cleanMessage;
            }
            if (in_array('body', $columns, true)) {
                $payload['body'] = $cleanMessage;
            }
            if (in_array('attachment', $columns, true)) {
                $payload['attachment'] = $attachmentPath;
            }
            if (in_array('image_path', $columns, true)) {
                $payload['image_path'] = $attachmentPath;
            }
            if (in_array('updated_at', $columns, true)) {
                $payload['updated_at'] = $now;
            }

            if (!array_key_exists('message', $payload) && !array_key_exists('body', $payload)) {
                throw new \RuntimeException('The messages table has no text column. Apply today.sql before sending messages.');
            }

            $id = DB::table('messages')->insertGetId($payload);
            $msg = Message::findOrFail($id);
        } catch (\Throwable $e) {
            Log::error('Message persistence failed', [
                'sender_id' => $user->id,
                'receiver_id' => $receiver->id,
                'has_attachment' => (bool) $attachmentPath,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Message could not be saved. Please try again.',
            ], 500);
        }

        $msgTextOut = $msg->message ?? ($msg->body ?? strip_tags($messageText));
        $attachmentUrlOut = method_exists($msg, 'getAttachmentUrlAttribute') ? $msg->attachment_url : ($attachmentPath ? asset($attachmentPath) : null);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id ?? time(),
                'sender_id' => $user->id,
                'receiver_id' => $request->receiver_id,
                'message' => $msgTextOut,
                'attachment' => $attachmentUrlOut,
                'time' => now()->format('h:i A'),
                'is_me' => true,
            ]
        ]);
    }

    public function fetchMessages(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $partnerId = (int)$request->query('partner_id');
        $afterId = (int)$request->query('after_id', 0);

        if (!$partnerId) {
            return response()->json(['success' => true, 'messages' => []]);
        }

        try {
            $newMessages = Message::where('sender_id', $partnerId)
                ->where('receiver_id', $user->id)
                ->where('id', '>', $afterId)
                ->orderBy('id', 'asc')
                ->get();

            if ($newMessages->isNotEmpty()) {
                try {
                    Message::whereIn('id', $newMessages->pluck('id'))->update(['is_read' => 1]);
                } catch (\Throwable $eRead) {}
            }

            return response()->json([
                'success' => true,
                'messages' => $newMessages->map(function($m) {
                    return [
                        'id' => $m->id,
                        'sender_id' => $m->sender_id,
                        'message' => $m->message ?: ($m->body ?? ''),
                        'attachment' => $m->attachment_url,
                        'time' => \Carbon\Carbon::parse($m->created_at)->format('h:i A'),
                        'is_me' => false,
                    ];
                })
            ]);
        } catch (\Throwable $e) {
            return response()->json(['success' => true, 'messages' => []]);
        }
    }

    public function getConversation(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false], 401);
        }

        $partnerId = $request->query('user_id');
        $partner = User::findOrFail($partnerId);

        $messages = Message::where(function($q) use ($user, $partner) {
            $q->where('sender_id', $user->id)->where('receiver_id', $partner->id);
        })->orWhere(function($q) use ($user, $partner) {
            $q->where('sender_id', $partner->id)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        // Mark unread as read
        Message::where('sender_id', $partner->id)
            ->where('receiver_id', $user->id)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        return response()->json([
            'success' => true,
            'partner' => [
                'id' => $partner->id,
                'name' => $partner->full_name,
                'avatar' => $partner->avatar_url,
                'country' => $partner->country,
                'bio' => $partner->bio,
                'member_id' => $partner->formatted_member_id,
                'is_verified' => (bool)$partner->is_verified,
                'coffee_style' => $partner->coffee_style ?? 'Vanilla Oat Latte',
            ],
            'messages' => $messages->map(function($m) use ($user) {
                return [
                    'id' => $m->id,
                    'sender_id' => $m->sender_id,
                    'message' => $m->message,
                    'attachment' => $m->attachment_url,
                    'time' => \Carbon\Carbon::parse($m->created_at)->format('h:i A'),
                    'is_me' => ($m->sender_id === $user->id),
                ];
            })
        ]);
    }
}
