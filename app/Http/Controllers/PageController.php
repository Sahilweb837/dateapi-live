<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\DatePlace;
use App\Models\User;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:180',
            'category' => 'nullable|string|max:80',
            'message' => 'required|string|max:3000',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'category' => $validated['category'] ?? 'general',
            'message' => $validated['message'],
            'status' => 'new',
            'ip_address' => $request->ip(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been received by the CupDate Grievance & Support team. We respond within 24 hours. ☕',
            ]);
        }

        return back()->with('success', 'Thank you! Your message has been received by our support team. ☕');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function safety()
    {
        return view('pages.safety');
    }

    public function communityGuidelines()
    {
        return view('pages.community-guidelines');
    }

    public function cookiePolicy()
    {
        return view('pages.cookie-policy');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function dates(Request $request)
    {
        $city = $request->query('city');
        $places = collect();
        $cities = collect(['Shimla', 'Manali', 'Dharamshala', 'Kasauli', 'Pune', 'Mumbai', 'Bangalore', 'Delhi NCR', 'Chandigarh']);

        try {
            $query = DatePlace::query();

            if ($city) {
                $query->where('city', 'like', "%{$city}%");
            }

            $places = $query->orderBy('rating', 'desc')->get();
            $dbCities = DatePlace::select('city')->distinct()->pluck('city');
            if ($dbCities->isNotEmpty()) {
                $cities = $dbCities;
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('DatePlace query fallback: ' . $e->getMessage());
        }

        if ($places->isEmpty()) {
            $places = $this->getFallbackPlaces($city);
        }

        return view('pages.dates', compact('places', 'cities', 'city'));
    }

    public function rishta()
    {
        try {
            $featuredSingles = User::where('status', 'active')
                ->where('is_verified', 1)
                ->where('is_admin', 0)
                ->whereNotNull('full_name')
                ->where('full_name', '!=', '')
                ->whereNotNull('avatar')
                ->where('avatar', '!=', '')
                ->take(8)
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Rishta user query fallback: ' . $e->getMessage());
            $featuredSingles = collect();
        }

        return view('pages.rishta', compact('featuredSingles'));
    }

    protected function getFallbackPlaces($city = null)
    {
        $all = collect([
            (object)[
                'id' => 1,
                'name' => 'Wake & Bake Cafe',
                'type' => 'Rooftop Mountain Cafe',
                'city' => 'Shimla',
                'description' => 'Iconic yellow window overlooking historic Mall Road. Serves artisan pour-overs, hand-tossed crepes, and warm apple pie with pine forest views.',
                'address' => 'The Mall, Near Town Hall, Shimla, Himachal Pradesh',
                'lat' => 31.1048,
                'lng' => 77.1734,
                'rating' => 4.9,
                'cup_offer' => '15% Off Total Bill',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 2,
                'name' => 'Cafe Simla Times',
                'type' => 'Heritage Boutique Cafe',
                'city' => 'Shimla',
                'description' => 'Artistic murals, outdoor terrace, and handcrafted cappuccinos. Enjoy crisp mountain air and live acoustic indie performances.',
                'address' => 'The Mall Road, Near Hotel Willow Banks, Shimla, Himachal Pradesh',
                'lat' => 31.1030,
                'lng' => 77.1740,
                'rating' => 4.8,
                'cup_offer' => 'Free Chocolate Truffle with 2 Coffees',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 3,
                'name' => 'Cafe 1947',
                'type' => 'Riverside Alpine Cafe',
                'city' => 'Manali',
                'description' => 'Historic riverside cafe perched right along the rushing Manalsu river in Old Manali. Famous for wood-fired pizzas and espresso.',
                'address' => 'Old Manali, Near Bridge, Manali, Himachal Pradesh',
                'lat' => 32.2530,
                'lng' => 77.1750,
                'rating' => 4.9,
                'cup_offer' => '15% Off Artisanal Roast Set',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 4,
                'name' => 'The Lazy Dog Lounge',
                'type' => 'Bohemian River Cafe',
                'city' => 'Manali',
                'description' => 'Rustic wooden deck overlooking the river. Cozy beanbags, fresh mountain brews, and quiet conversation corners.',
                'address' => 'Manu Temple Road, Old Manali, Himachal Pradesh',
                'lat' => 32.2560,
                'lng' => 77.1720,
                'rating' => 4.7,
                'cup_offer' => 'Free Double Shot Espresso Upgrade',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 5,
                'name' => 'Illiterati Books & Coffee',
                'type' => 'Literary Mountain Cafe',
                'city' => 'Dharamshala',
                'description' => 'Balcony seating overlooking the Kangra Valley. Thousands of curated books, authentic Italian roast espresso, and quiet fireplace ambience.',
                'address' => 'Jogiwara Road, McLeod Ganj, Dharamshala, Himachal Pradesh',
                'lat' => 32.2350,
                'lng' => 76.3260,
                'rating' => 4.9,
                'cup_offer' => 'Free Artisanal Cookie on Coffee Date',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 6,
                'name' => 'Cafe Rudra',
                'type' => 'Cozy Hilltop Cafe',
                'city' => 'Kasauli',
                'description' => 'Charming hill-station cafe famous for acoustic guitar jams, herbal teas, and hazelnut lattes away from tourist traffic.',
                'address' => 'Heritage Market, Mall Road, Kasauli, Himachal Pradesh',
                'lat' => 30.9013,
                'lng' => 76.9649,
                'rating' => 4.7,
                'cup_offer' => '10% Off CupDate Members',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 7,
                'name' => 'Blue Tokai Coffee Roasters',
                'type' => 'Specialty Cafe',
                'city' => 'Pune',
                'description' => 'Cozy botanical courtyard with artisan pour-overs and organic sourdough.',
                'address' => 'Koregaon Park, North Main Road, Pune',
                'lat' => 18.5362,
                'lng' => 73.8938,
                'rating' => 4.8,
                'cup_offer' => '15% Off Total Bill',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 8,
                'name' => 'Subko Coffee Roasters & Bakehouse',
                'type' => 'Artisanal Roastery',
                'city' => 'Mumbai',
                'description' => 'Vintage converted heritage home serving single-origin Indian arabica and craft pastries.',
                'address' => 'Chapel Road, Bandra West, Mumbai',
                'lat' => 19.0558,
                'lng' => 72.8295,
                'rating' => 4.9,
                'cup_offer' => 'Free Signature Cold Brew on Date',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 9,
                'name' => 'Araku Coffee Landmark',
                'type' => 'Luxury Coffee Lounge',
                'city' => 'Bangalore',
                'description' => 'World-class regenerative micro-lot coffees with award-winning ambient architecture.',
                'address' => '12th Main Road, Indiranagar, Bangalore',
                'lat' => 12.9719,
                'lng' => 77.6412,
                'rating' => 4.9,
                'cup_offer' => '20% Off Artisanal Tasting Set',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 10,
                'name' => 'CaPhe Roasters & Vietnamese Brews',
                'type' => 'Cozy Date Spot',
                'city' => 'Delhi NCR',
                'description' => 'Intimate string-lit patio offering rich egg coffees, matcha lattes, and jazz vinyls.',
                'address' => 'Champa Gali, Saket, New Delhi',
                'lat' => 28.5186,
                'lng' => 77.2023,
                'rating' => 4.7,
                'cup_offer' => 'Buy 1 Get 1 on Handcrafted Drinks',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
            (object)[
                'id' => 11,
                'name' => 'Backyard Cafe & Roastery',
                'type' => 'Garden Cafe',
                'city' => 'Chandigarh',
                'description' => 'Lush shaded garden seating ideal for relaxed afternoon first meets.',
                'address' => 'Sector 9-D, Inner Market, Chandigarh',
                'lat' => 30.7410,
                'lng' => 76.7865,
                'rating' => 4.6,
                'cup_offer' => 'Free Double Shot Espresso Upgrade',
                'image_url' => 'assets/images/default_cafe.jpg',
            ],
        ]);

        if ($city) {
            $filtered = $all->filter(function($p) use ($city) {
                return stripos($p->city, $city) !== false || stripos($p->name, $city) !== false;
            });
            return $filtered->isNotEmpty() ? $filtered->values() : $all;
        }

        return $all;
    }

    public function disclaimer()
    {
        return view('pages.disclaimer');
    }

    public function aiBioGenerator()
    {
        return view('pages.ai-bio-generator');
    }

    public function coffeeDateIdeas()
    {
        return view('pages.coffee-date-ideas');
    }
}
