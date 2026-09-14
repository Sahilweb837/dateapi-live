<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatePlace;
use App\Models\User;

class CityController extends Controller
{
    protected $cityData = [
        'shimla' => [
            'name' => 'Shimla, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'headline' => 'Meet Verified Singles Over Mountain Brews in Shimla',
            'intro' => 'From the heritage colonial charm of The Mall Road to quiet pine-scented cafe verandas in Jakhoo and Summer Hill, Shimla is India’s quintessential mountain romance destination.',
            'popular_cafes' => ['Cafe Simla Times', 'Wake & Bake Cafe', 'Honey Hut Mall Road', 'The Devicos'],
            'safety_score' => '99.7%',
            'icon' => 'mountain',
        ],
        'manali' => [
            'name' => 'Manali & Old Manali, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'headline' => 'Alpine Coffee Dates & Bohemian Romance in Old Manali',
            'intro' => 'Riverside espresso lounges, wooden log cabins, and scenic apple orchard cafes provide the perfect backdrop for low-pressure 45-minute coffee dates.',
            'popular_cafes' => ['Cafe 1947', 'The Lazy Dog Lounge', 'Drifters Cafe Old Manali', 'Renaissance Manali'],
            'safety_score' => '99.5%',
            'icon' => 'snowflake',
        ],
        'dharamshala' => [
            'name' => 'Dharamshala & McLeodGanj, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'headline' => 'Artisan Tibetan Brews & Soulful Conversations in McLeodGanj',
            'intro' => 'A tranquil sanctuary for intellectuals, artists, and soulful singles. Discuss literature, philosophy, and indie acoustic music over organic Himalayan teas and roasted pour-overs.',
            'popular_cafes' => ['Illiterati Books & Coffee', 'Shiva Cafe Bhagsu', 'Common Ground Cafe', 'Trek & Dine'],
            'safety_score' => '99.8%',
            'icon' => 'sun',
        ],
        'kasauli' => [
            'name' => 'Kasauli & Solan, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'headline' => 'Quiet Pine Forests & Sunset Dates in Kasauli Hills',
            'intro' => 'Uncluttered walking trails, historic heritage churches, and peaceful scenic viewpoints for romantic coffee meets away from city noise.',
            'popular_cafes' => ['Cafe Rudra', 'Hangout Rooftop Bar & Lounge', 'Old Town Coffee Kasauli'],
            'safety_score' => '99.6%',
            'icon' => 'tree',
        ],
        'pune' => [
            'name' => 'Pune, Maharashtra',
            'state' => 'Maharashtra',
            'headline' => 'Specialty Roasteries & Courtyard Coffee Dates in Pune',
            'intro' => 'Koregaon Park, Kalyani Nagar, and FC Road offer the richest specialty coffee community in India with verified singles meeting at botanical cafes.',
            'popular_cafes' => ['Blue Tokai Koregaon Park', 'Le Plaisir', 'One O Eight Cafe', 'Vohuman Cafe'],
            'safety_score' => '99.8%',
            'icon' => 'mug-hot',
        ],
        'mumbai' => [
            'name' => 'Mumbai, Maharashtra',
            'state' => 'Maharashtra',
            'headline' => 'Bandra Heritage Cafes & Sea-Breeze Dates in Mumbai',
            'intro' => 'Escape the city rush with cozy 45-minute coffee dates across Bandra West, Colaba, and Juhu heritage bakehouses.',
            'popular_cafes' => ['Subko Coffee Bandra', 'Kala Ghoda Cafe', 'Bastian', 'Prithvi Cafe Juhu'],
            'safety_score' => '99.6%',
            'icon' => 'city',
        ],
        'bangalore' => [
            'name' => 'Bangalore, Karnataka',
            'state' => 'Karnataka',
            'headline' => 'Garden City Specialty Cafes & Tech Singles in Bangalore',
            'intro' => 'Indiranagar, Koramangala, and Lavelle Road host India’s most vibrant coffee innovators, combining single-origin pour-overs with high-chemistry conversations.',
            'popular_cafes' => ['Araku Coffee Indiranagar', 'Third Wave Roasters', 'Brik Oven', 'The Hole in the Wall'],
            'safety_score' => '99.7%',
            'icon' => 'laptop',
        ],
        'delhi' => [
            'name' => 'Delhi NCR',
            'state' => 'Delhi NCR',
            'headline' => 'Artisan Roasters & Champa Gali Dates in Delhi NCR',
            'intro' => 'From Saket’s Champa Gali fairy-lit paths to Hauz Khas Village and CyberHub, connect with verified singles over craft coffees.',
            'popular_cafes' => ['CaPhe Roasters Saket', 'Blue Tokai Saidulajab', 'Colocal Dhan Mill', 'Perch Wine & Coffee Bar'],
            'safety_score' => '99.4%',
            'icon' => 'landmark',
        ],
        'chandigarh' => [
            'name' => 'Chandigarh City Beautiful',
            'state' => 'Punjab & Haryana',
            'headline' => 'Sector 9 Boulevard Cafes & Relaxed Dates in Chandigarh',
            'intro' => 'Tree-lined wide avenues, calm garden cafes, and open-air seating for graceful first meets.',
            'popular_cafes' => ['Backyard Cafe Sector 9', 'Backpackers Cafe', 'Books & Brew', 'The Willow Cafe'],
            'safety_score' => '99.8%',
            'icon' => 'leaf',
        ],
        'jaipur' => [
            'name' => 'Jaipur, Rajasthan',
            'state' => 'Rajasthan',
            'headline' => 'Pink City Heritage Cafes & Courtyard Coffee Dates in Jaipur',
            'intro' => 'C-Scheme and Malviya Nagar offer stunning rooftop cafe views, artisan bakeries, and cultured singles.',
            'popular_cafes' => ['Tapri The Tea House', 'Curious Gull', 'Anokhi Cafe', 'Stepout Cafe'],
            'safety_score' => '99.6%',
            'icon' => 'chess-rook',
        ],
        'goa' => [
            'name' => 'Goa',
            'state' => 'Goa',
            'headline' => 'Portuguese Villas & Sunset Espresso Dates in Goa',
            'intro' => 'Assagao, Anjuna, and Fontainhas Latin Quarter provide slow, romantic cafe afternoons with verified singles.',
            'popular_cafes' => ['Babka Goa', 'Gulaebola Assagao', 'Caravela Cafe Panjim', 'Artjuna'],
            'safety_score' => '99.7%',
            'icon' => 'umbrella-beach',
        ],
    ];

    public function index()
    {
        $cities = $this->cityData;
        return view('pages.cities-index', compact('cities'));
    }

    public function show($slug)
    {
        $slug = strtolower($slug);
        $city = $this->cityData[$slug] ?? null;

        if (!$city) {
            // Default fallback city
            $city = [
                'name' => ucfirst($slug) . ', India',
                'state' => 'India',
                'headline' => 'Meet Verified Singles Over Coffee in ' . ucfirst($slug),
                'intro' => 'Connect with selfie-verified singles for respectful, low-pressure 45-minute coffee dates.',
                'popular_cafes' => ['Specialty Coffee Roasters', 'City Garden Cafe', 'Central Artisan Lounge'],
                'safety_score' => '99.6%',
                'icon' => 'mug-hot',
            ];
        }

        // Query singles matching this city or state
        $singles = User::where('status', 'active')
            ->where(function($q) use ($city, $slug) {
                $q->where('country', 'like', "%{$slug}%")
                  ->orWhere('country', 'like', "%{$city['state']}%")
                  ->orWhere('is_verified', 1);
            })
            ->take(6)
            ->get();

        // Local cafe spots
        $cafes = DatePlace::where('city', 'like', "%{$slug}%")
            ->orWhere('city', 'like', "%" . explode(',', $city['name'])[0] . "%")
            ->take(4)
            ->get();

        return view('pages.city', compact('city', 'slug', 'singles', 'cafes'));
    }
}
