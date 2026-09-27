<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatePlace;
use App\Models\User;
use App\Services\CityDirectory;

class CityController extends Controller
{
    /**
     * Get all cities from the comprehensive directory (100+ Hubs)
     */
    protected function getCities(): array
    {
        return CityDirectory::all();
    }

    public function index()
    {
        $cities = $this->getCities();
        
        $internationalCities = collect($cities)
            ->filter(fn($c) => ($c['region'] ?? '') === 'International')
            ->map(fn($c) => $c['name'])
            ->toArray();

        return view('pages.cities-index', compact('cities', 'internationalCities'));
    }

    public function show($slug)
    {
        $slug = strtolower(trim($slug));
        $cities = $this->getCities();
        $city = $cities[$slug] ?? null;

        if (!$city) {
            $formattedName = ucwords(str_replace('-', ' ', $slug));
            $city = [
                'name' => $formattedName . ', India',
                'state' => 'India',
                'region' => 'India',
                'headline' => 'Meet Verified Singles Over Coffee in ' . $formattedName,
                'intro' => 'Connect with real CupDate members in ' . $formattedName . ' for respectful online chat, one-to-one introductions, and safe public dates. Profiles and availability vary by city.',
                'popular_cafes' => ['Specialty Coffee Roasters', 'City Garden Cafe', 'Central Artisan Lounge', 'The Terrace Bistro'],
                'safety_score' => '99.7%',
                'icon' => 'mug-hot',
                'dating_tips' => 'Choose a well-lit, popular daytime cafe. Keep the first meet to 45 minutes to enjoy genuine conversation without pressure.',
            ];
        }

        $cityNameOnly = explode(',', $city['name'])[0];

        // Query singles matching this city or state
        try {
            $singles = User::where('status', 'active')
                ->where('is_admin', 0)
                ->whereNotNull('full_name')
                ->where('full_name', '!=', '')
                ->whereNotNull('avatar')
                ->where('avatar', '!=', '')
                ->where(function($q) use ($city, $slug, $cityNameOnly) {
                    $q->where('country', 'like', "%{$slug}%")
                      ->orWhere('country', 'like', "%{$cityNameOnly}%")
                      ->orWhere('country', 'like', "%{$city['state']}%");
                })
                ->take(6)
                ->get();

            // If no local singles yet, showcase other verified active members
            if ($singles->isEmpty()) {
                $singles = User::where('status', 'active')
                    ->where('is_admin', 0)
                    ->whereNotNull('full_name')
                    ->where('full_name', '!=', '')
                    ->whereNotNull('avatar')
                    ->where('avatar', '!=', '')
                    ->take(6)
                    ->get();
            }
        } catch (\Throwable $e) {
            $singles = collect();
        }

        // Local cafe spots
        $curatedCafeImages = [
            'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80&fit=crop',
            'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&q=80&fit=crop',
            'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&q=80&fit=crop',
            'https://images.unsplash.com/photo-1521017432531-fbd92d768814?w=600&q=80&fit=crop',
        ];

        try {
            $cafes = DatePlace::where('city', 'like', "%{$slug}%")
                ->orWhere('city', 'like', "%{$cityNameOnly}%")
                ->take(4)
                ->get();

            foreach ($cafes as $idx => $cafe) {
                if (empty($cafe->image)) {
                    $cafe->image = $curatedCafeImages[$idx % count($curatedCafeImages)];
                }
            }
        } catch (\Throwable $e) {
            $cafes = collect();
        }

        // Fallback cafes if date places not seeded for small stations
        if ($cafes->isEmpty()) {
            $cafes = collect();
            $cafeList = $city['popular_cafes'] ?? ['Artisan Roastery', 'Central Cafe', 'Garden Bistro', 'Hill Lounge'];
            foreach ($cafeList as $index => $cName) {
                $cafes->push((object)[
                    'id' => $index + 100,
                    'name' => $cName,
                    'type' => 'Curated Dating Partner Cafe',
                    'city' => $cityNameOnly,
                    'address' => $cityNameOnly . ', ' . $city['state'],
                    'cup_offer' => '15% Off Total Bill for CupDate Singles',
                    'rating' => 4.8 + ($index * 0.05),
                    'image' => $curatedCafeImages[$index % count($curatedCafeImages)],
                ]);
            }
        }

        // Related nearby cities in the same region
        $relatedCities = collect($cities)
            ->filter(function($c, $k) use ($slug, $city) {
                return $k !== $slug && ($c['state'] === $city['state'] || $c['region'] === $city['region']);
            })
            ->take(6);

        return view('pages.city', compact('city', 'slug', 'singles', 'cafes', 'relatedCities'));
    }
}
