<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\MatchModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $allPartnerIds = collect($matches)->merge($messagedUsers)->unique()->values();

        // If no conversations yet, provide top recommended verified daters
        if ($allPartnerIds->isEmpty()) {
            $allPartnerIds = User::where('id', '!=', $user->id)
                ->where('status', 'active')
                ->take(6)
                ->pluck('id');
        }

        $partners = User::whereIn('id', $allPartnerIds)->get();

        $activePartner = null;
        if ($activePartnerId) {
            $activePartner = User::find($activePartnerId);
        } elseif ($partners->isNotEmpty()) {
            $activePartner = $partners->first();
        }

        $messages = [];
        if ($activePartner) {
            $messages = Message::where(function($q) use ($user, $activePartner) {
                $q->where('sender_id', $user->id)->where('receiver_id', $activePartner->id);
            })->orWhere(function($q) use ($user, $activePartner) {
                $q->where('sender_id', $activePartner->id)->where('receiver_id', $user->id);
            })->orderBy('created_at', 'asc')->get();

            // Mark unread as read
            Message::where('sender_id', $activePartner->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        }

        return view('messages', compact('user', 'partners', 'activePartner', 'messages'));
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

        $msg = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => strip_tags($messageText),
            'attachment' => $attachmentPath,
            'is_read' => 0,
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'sender_id' => $msg->sender_id,
                'receiver_id' => $msg->receiver_id,
                'message' => $msg->message,
                'attachment' => $msg->attachment_url,
                'time' => now()->format('h:i A'),
                'is_me' => true,
            ]
        ]);
    }

    public function fetchMessages(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false], 401);
        }

        $partnerId = $request->query('partner_id');
        $afterId = $request->query('after_id', 0);

        $newMessages = Message::where('sender_id', $partnerId)
            ->where('receiver_id', $user->id)
            ->where('id', '>', $afterId)
            ->orderBy('id', 'asc')
            ->get();

        if ($newMessages->isNotEmpty()) {
            Message::whereIn('id', $newMessages->pluck('id'))->update(['is_read' => 1]);
        }

        return response()->json([
            'success' => true,
            'messages' => $newMessages->map(function($m) {
                return [
                    'id' => $m->id,
                    'sender_id' => $m->sender_id,
                    'message' => $m->message,
                    'attachment' => $m->attachment_url,
                    'time' => \Carbon\Carbon::parse($m->created_at)->format('h:i A'),
                    'is_me' => false,
                ];
            })
        ]);
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

        // Mark read
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
                'member_id' => $partner->formatted_member_id,
                'is_verified' => (bool)$partner->is_verified,
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
