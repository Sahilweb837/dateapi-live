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
                ->take(8)
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Rishta user query fallback: ' . $e->getMessage());
            $featuredSingles = collect();
        }

        if ($featuredSingles->isEmpty()) {
            $featuredSingles = $this->getFallbackSingles();
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

    protected function getFallbackSingles()
    {
        return collect([
            new User([
                'id' => 1,
                'member_code' => 'CD-10001',
                'full_name' => 'Aditi Rao',
                'email' => 'aditi.rao@cupdate.in',
                'gender' => 'female',
                'dob' => '1999-05-14',
                'country' => 'Pune, India',
                'interests' => 'Coffee, Books, Photography, Vinyl Records',
                'bio' => 'Specialty coffee enthusiast, amateur film photographer, and indie acoustic fan. Let us explore Blue Tokai or Wake & Bake! ☕📸',
                'coffee_style' => 'Vanilla Oat Milk Latte',
                'is_verified' => 1,
                'coins' => 150,
                'xp' => 80,
                'status' => 'active',
                'avatar' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80&fit=crop&crop=face',
            ]),
            new User([
                'id' => 2,
                'member_code' => 'CD-10002',
                'full_name' => 'Rahul Kapoor',
                'email' => 'rahul.kapoor@cupdate.in',
                'gender' => 'male',
                'dob' => '1997-11-20',
                'country' => 'Mumbai, India',
                'interests' => 'Architecture, Espresso, Hiking, Jazz',
                'bio' => 'Architect by day, espresso aficionado by night. Always looking for cozy cafes with good reading corners.',
                'coffee_style' => 'Double Espresso Macchiato',
                'is_verified' => 1,
                'coins' => 100,
                'xp' => 45,
                'status' => 'active',
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop&crop=face',
            ]),
            new User([
                'id' => 3,
                'member_code' => 'CD-10003',
                'full_name' => 'Tanya Sharma',
                'email' => 'tanya.sharma@cupdate.in',
                'gender' => 'female',
                'dob' => '1998-08-22',
                'country' => 'Shimla, Himachal Pradesh',
                'interests' => 'Trekking, Specialty Coffee, Poetry, Himalayas',
                'bio' => 'Born in Shimla, lover of cedar trails, hot cappuccinos at Cafe Simla Times, and soulful poetry.',
                'coffee_style' => 'Cinnamon Honey Latte',
                'is_verified' => 1,
                'coins' => 200,
                'xp' => 110,
                'status' => 'active',
                'avatar' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80&fit=crop&crop=face',
            ]),
            new User([
                'id' => 4,
                'member_code' => 'CD-10004',
                'full_name' => 'Vikram Thakur',
                'email' => 'vikram.thakur@cupdate.in',
                'gender' => 'male',
                'dob' => '1996-03-12',
                'country' => 'Manali, Himachal Pradesh',
                'interests' => 'Snowboarding, Pour-overs, Indie Rock, Camping',
                'bio' => 'Old Manali local, backcountry snowboarder, and French roast barista. Let us grab a table at Cafe 1947 by the river.',
                'coffee_style' => 'French Press Dark Roast',
                'is_verified' => 1,
                'coins' => 120,
                'xp' => 60,
                'status' => 'active',
                'avatar' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&q=80&fit=crop&crop=face',
            ]),
        ]);
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

