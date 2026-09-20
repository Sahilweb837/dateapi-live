<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FeedController extends Controller
{
    protected $popularCities = [
        'All Cities',
        'Delhi NCR',
        'Mumbai',
        'Bangalore',
        'Pune',
        'Shimla',
        'Chandigarh',
        'Kangra',
        'Dharamshala',
        'Manali',
        'Jaipur',
        'Goa',
        'Kolkata',
        'Hyderabad',
        'Solan',
    ];

    public function index(Request $request)
    {
        $user = Auth::user();
        $selectedCity = $request->query('city', 'all');

        // Check if database needs initial sample ideas
        $this->ensureInitialIdeas();

        try {
            $query = Idea::with('user');

            if ($selectedCity && strtolower($selectedCity) !== 'all' && strtolower($selectedCity) !== 'all cities') {
                $query->where(function($q) use ($selectedCity) {
                    $q->where('city', 'LIKE', '%' . $selectedCity . '%')
                      ->orWhere('cafe_name', 'LIKE', '%' . $selectedCity . '%');
                });
            }

            $ideas = $query->orderBy('id', 'desc')
                ->take(40)
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Feed ideas query fallback: ' . $e->getMessage());
            $ideas = collect();
        }

        try {
            $activeDaters = User::where('status', 'active')
                ->where('is_admin', 0)
                ->when($user, function($query) use ($user) {
                    return $query->where('id', '!=', $user->id);
                })
                ->whereNotNull('full_name')
                ->where('full_name', '!=', '')
                ->whereNotNull('avatar')
                ->where('avatar', '!=', '')
                ->orderBy('last_active', 'desc')
                ->take(14)
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Feed activeDaters query fallback: ' . $e->getMessage());
            $activeDaters = collect();
        }

        $cities = $this->popularCities;

        return view('feed', compact('user', 'ideas', 'activeDaters', 'cities', 'selectedCity'));
    }

    public function postIdea(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'cafe_name' => 'nullable|string|max:150',
            'city' => 'nullable|string|max:80',
            'vibe' => 'nullable|string|max:50',
            'budget' => 'nullable|string|max:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to pitch a date idea.'
            ], 401);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = 'idea_' . $user->id . '_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $destDir = public_path('uploads/ideas');
                if (!is_dir($destDir)) {
                    @mkdir($destDir, 0755, true);
                }
                $file->move($destDir, $filename);
                $imagePath = 'uploads/ideas/' . $filename;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Idea image upload error: ' . $e->getMessage());
            }
        }

        $content = trim($request->input('content', ''));
        $cafe = trim($request->input('cafe_name', ''));
        if (empty($cafe)) $cafe = 'Cozy Coffee Sanctuary';
        $city = trim($request->input('city', ''));
        if (empty($city)) $city = $user->country ?? 'Delhi NCR';
        $vibe = trim($request->input('vibe', 'Cozy & Aesthetic'));
        $budget = trim($request->input('budget', '₹₹'));

        // Dynamically detect table columns to avoid any unknown column SQL errors
        $columns = [];
        try {
            $columns = Schema::getColumnListing('ideas');
        } catch (\Throwable $e) {}

        $insert = [
            'user_id' => $user->id,
            'created_at' => now(),
        ];

        if (empty($columns) || in_array('idea_text', $columns)) {
            $insert['idea_text'] = $content;
        }
        if (empty($columns) || in_array('content', $columns)) {
            $insert['content'] = $content;
        }
        if (empty($columns) || in_array('cafe_name', $columns)) {
            $insert['cafe_name'] = $cafe;
        }
        if (empty($columns) || in_array('city', $columns)) {
            $insert['city'] = $city;
        }
        if (empty($columns) || in_array('vibe', $columns)) {
            $insert['vibe'] = $vibe;
        }
        if (empty($columns) || in_array('budget', $columns)) {
            $insert['budget'] = $budget;
        }
        if (empty($columns) || in_array('sparks', $columns)) {
            $insert['sparks'] = 0;
        }
        if (in_array('sparks_count', $columns)) {
            $insert['sparks_count'] = 0;
        }
        if ($imagePath) {
            if (empty($columns) || in_array('image', $columns)) {
                $insert['image'] = $imagePath;
            }
            if (in_array('image_path', $columns)) {
                $insert['image_path'] = $imagePath;
            }
        }

        try {
            $idea = Idea::create($insert);
        } catch (\Throwable $e) {
            // Fallback DB insert with minimal standard columns if Eloquent hits any strict mode issue
            try {
                $id = DB::table('ideas')->insertGetId([
                    'user_id' => $user->id,
                    'idea_text' => $content,
                    'cafe_name' => $cafe,
                    'city' => $city,
                    'sparks' => 0,
                    'created_at' => now(),
                ]);
                $idea = Idea::find($id);
            } catch (\Throwable $e2) {
                return response()->json([
                    'success' => false,
                    'message' => 'Database error: ' . $e2->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Your coffee date idea was published! ☕',
            'idea' => [
                'id' => $idea->id,
                'content' => $idea->content,
                'idea_text' => $idea->idea_text,
                'cafe_name' => $idea->cafe_name,
                'city' => $idea->city,
                'vibe' => $idea->vibe ?? 'Cozy',
                'budget' => $idea->budget ?? '₹₹',
                'image_url' => $idea->image_url,
                'sparks_count' => 0,
                'user_id' => $user->id,
                'user_name' => $user->full_name,
                'user_avatar' => $user->avatar_url,
                'time_ago' => 'Just now',
            ],
        ]);
    }

    public function sparkIdea(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please log in to send a spark.'], 401);
        }

        try {
            $idea = Idea::findOrFail($id);

            // Increment sparks with schema awareness
            try {
                $idea->increment('sparks');
            } catch (\Throwable $e) {
                try {
                    $idea->increment('sparks_count');
                } catch (\Throwable $e2) {}
            }

            // Track spark in idea_sparks if table exists
            try {
                DB::table('idea_sparks')->updateOrInsert(
                    ['idea_id' => $id, 'user_id' => $user->id],
                    ['created_at' => now()]
                );
            } catch (\Throwable $e) {}

            $sparks = $idea->sparks_count ?? $idea->sparks ?? 1;

            return response()->json([
                'success' => true,
                'sparks' => $sparks,
            ]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Idea not found.'], 404);
        }
    }

    /**
     * Seeds initial community coffee date ideas if table has fewer than 6 entries.
     */
    protected function ensureInitialIdeas(): void
    {
        try {
            if (Idea::count() >= 6) {
                return;
            }

            $users = User::where('status', 'active')->take(8)->get();
            if ($users->isEmpty()) {
                return;
            }

            $sampleIdeas = [
                [
                    'cafe_name' => 'Cafe Simla Times',
                    'city' => 'Shimla',
                    'vibe' => 'Mountain View & Fireplace',
                    'budget' => '₹₹',
                    'content' => 'Sun-drenched corner table at Cafe Simla Times with hot cinnamon cappuccino, overlooking the misty pine valley of Shimla. Ideal for unhurried conversations.',
                    'image' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=700&q=80&fit=crop',
                    'sparks' => 24,
                ],
                [
                    'cafe_name' => 'Subko Coffee Roasters',
                    'city' => 'Mumbai',
                    'vibe' => 'Artisan Roastery & Vinyl',
                    'budget' => '₹₹₹',
                    'content' => 'Lavender iced latte and sourdough croissants in the leafy Bandra courtyard. Discussing favorite vinyl albums and Sunday morning walk playlists.',
                    'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=700&q=80&fit=crop',
                    'sparks' => 38,
                ],
                [
                    'cafe_name' => 'Blue Tokai Cafe Galleria',
                    'city' => 'Delhi NCR',
                    'vibe' => 'Specialty Pour-over',
                    'budget' => '₹₹',
                    'content' => 'Single-origin Chemex brew with almond biscotti. Quiet afternoon daylight and low-pressure talk about books and travel.',
                    'image' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=700&q=80&fit=crop',
                    'sparks' => 19,
                ],
                [
                    'cafe_name' => 'Third Wave Coffee Indiranagar',
                    'city' => 'Bangalore',
                    'vibe' => 'Breezy Balcony Corner',
                    'budget' => '₹₹',
                    'content' => 'AeroPress cold drip and banana walnut loaf on the open balcony under the gulmohar trees. Perfect 45-minute chemistry check.',
                    'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=700&q=80&fit=crop',
                    'sparks' => 31,
                ],
                [
                    'cafe_name' => 'French Window Patisserie',
                    'city' => 'Pune',
                    'vibe' => 'Garden Conservatory',
                    'budget' => '₹₹',
                    'content' => 'Cold brew tonic and hazelnut eclairs under the banyan trees in Koregaon Park. Quiet acoustics with zero background noise.',
                    'image' => 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?w=700&q=80&fit=crop',
                    'sparks' => 15,
                ],
                [
                    'cafe_name' => 'Cafe 1947 Old Manali',
                    'city' => 'Manali',
                    'vibe' => 'Riverside Wooden Deck',
                    'budget' => '₹₹',
                    'content' => 'French press coffee sitting right next to the roaring Manalsu river stream, wrapped in warm fleece with acoustic indie music in the background.',
                    'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=700&q=80&fit=crop',
                    'sparks' => 42,
                ],
                [
                    'cafe_name' => 'Curious Life Coffee Roasters',
                    'city' => 'Jaipur',
                    'vibe' => 'Specialty Cortado',
                    'budget' => '₹₹',
                    'content' => 'Velvety cortado and dark chocolate sea salt cookies in C-Scheme. Clean minimalist space with great natural morning light.',
                    'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=700&q=80&fit=crop',
                    'sparks' => 22,
                ],
                [
                    'cafe_name' => 'Barefoot Cafe Assagao',
                    'city' => 'Goa',
                    'vibe' => 'Portuguese Villa Garden',
                    'budget' => '₹₹',
                    'content' => 'Iced Americano under the bougainvillea in Assagao. Warm ocean breeze, laid-back vibe, and genuine conversation.',
                    'image' => 'https://images.unsplash.com/photo-1498804103079-a6351b050096?w=700&q=80&fit=crop',
                    'sparks' => 29,
                ],
            ];

            foreach ($sampleIdeas as $idx => $sample) {
                $user = $users[$idx % $users->count()];
                Idea::create([
                    'user_id' => $user->id,
                    'idea_text' => $sample['content'],
                    'content' => $sample['content'],
                    'cafe_name' => $sample['cafe_name'],
                    'city' => $sample['city'],
                    'vibe' => $sample['vibe'],
                    'budget' => $sample['budget'],
                    'image' => $sample['image'],
                    'sparks' => $sample['sparks'],
                    'sparks_count' => $sample['sparks'],
                    'created_at' => now()->subHours(rand(1, 48)),
                ]);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::info('ensureInitialIdeas note: ' . $e->getMessage());
        }
    }
}
