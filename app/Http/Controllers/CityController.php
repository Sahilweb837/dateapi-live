<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatePlace;
use App\Models\User;

class CityController extends Controller
{
    protected $cityData = [
        // ==========================================
        // 1. HIMACHAL PRADESH DATING HUBS & DISTRICTS
        // ==========================================
        'kangra' => [
            'name' => 'Kangra, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Meet Verified Singles Amidst Lush Tea Gardens & Valleys of Kangra',
            'intro' => 'With the majestic Dhauladhar ranges as your backdrop, historic Kangra offers lush terraced tea estates, ancient fort pathways, and peaceful stream-side cafes for romantic 45-minute coffee dates.',
            'popular_cafes' => ['Dharamsala Tea Estate Veranda', 'Kangra Valley Roastery', 'The Hill View Cafe', 'Trilokpur Stream Lounge'],
            'safety_score' => '99.9%',
            'icon' => 'mountain-sun',
            'dating_tips' => 'Take an afternoon stroll through the surrounding tea gardens or meet at a cozy open-air terrace in Kangra town. Modest, polite conversation and sharing authentic Himalayan mountain tea make for ideal first dates.',
        ],
        'solan' => [
            'name' => 'Solan, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Pine-Scented Walks & Cozy Coffee Dates in Solan (The Mushroom City)',
            'intro' => 'Surrounded by pine-covered hills, Mohan Park overlooks, and pleasant mountain air, Solan is a peaceful dating haven for intentional singles seeking genuine conversation without metropolitan rush.',
            'popular_cafes' => ['Old Solan Mall Cafe', 'The Himalayan Brew Solan', 'Pine Crest Veranda', 'Shoolini Heritage Lounge'],
            'safety_score' => '99.8%',
            'icon' => 'tree',
            'dating_tips' => 'Plan a calm meetup around Mall Road or Mohan Shakti Heritage Park cafe corners. Solan locals appreciate grounded conversations about career, hobbies, and mutual family values.',
        ],
        'shimla' => [
            'name' => 'Shimla, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Meet Verified Singles Over Mountain Brews in Historic Shimla',
            'intro' => 'From the colonial heritage charm of The Mall Road and The Ridge to quiet pine-scented cafe verandas in Jakhoo and Summer Hill, Shimla is India’s quintessential mountain romance capital.',
            'popular_cafes' => ['Cafe Simla Times', 'Wake & Bake Cafe', 'Honey Hut Mall Road', 'The Devicos Lounge'],
            'safety_score' => '99.7%',
            'icon' => 'mountain',
            'dating_tips' => 'A walk from Scandal Point toward Christ Church followed by hot cinnamon lattes at Cafe Simla Times is Shimla’s gold standard for a graceful first coffee date.',
        ],
        'manali' => [
            'name' => 'Manali & Old Manali, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Alpine Coffee Dates & Riverside Romance in Old Manali',
            'intro' => 'Riverside espresso lounges, wooden log cabins, and scenic apple orchard cafes along the roaring Manalsu river provide the perfect backdrop for low-pressure 45-minute coffee dates.',
            'popular_cafes' => ['Cafe 1947', 'The Lazy Dog Lounge', 'Drifters Cafe Old Manali', 'Renaissance Manali'],
            'safety_score' => '99.5%',
            'icon' => 'snowflake',
            'dating_tips' => 'Choose a riverside outdoor wooden deck in Old Manali. Discuss favorite Himalayan hiking trails, snowboarding, acoustic music, and travel over artisan French press coffee.',
        ],
        'dharamshala' => [
            'name' => 'Dharamshala & McLeodGanj, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Artisan Tibetan Brews & Soulful Mountain Conversations in McLeodGanj',
            'intro' => 'A peaceful mountain sanctuary for intellectuals, creators, and soulful singles. Discuss literature, philosophy, and indie acoustic music over organic Himalayan herbal brews and pour-overs.',
            'popular_cafes' => ['Illiterati Books & Coffee', 'Shiva Cafe Bhagsu', 'Common Ground Cafe', 'Trek & Dine'],
            'safety_score' => '99.8%',
            'icon' => 'book-open',
            'dating_tips' => 'Illiterati Books & Coffee with its balcony view of Kangra valley is legendary for first dates. Browse books together before sitting down for authentic Italian roast coffee.',
        ],
        'mandi' => [
            'name' => 'Mandi (Chhoti Kashi), Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Riverside Beas Promenades & Historic Dates in Mandi',
            'intro' => 'Known as the Varanasi of the Hills, Mandi pairs 81 historic stone temples with scenic banks along the Beas River, Sunken Garden cafes, and serene dating spots for educated professionals.',
            'popular_cafes' => ['Sunken Garden Cafe', 'Beas Riverfront Lounge', 'Chhoti Kashi Coffee Bar', 'Victoria Bridge View Cafe'],
            'safety_score' => '99.8%',
            'icon' => 'landmark',
            'dating_tips' => 'Sunken Garden in the center of town is an ideal daylight meeting spot. Keep dates respectful, relaxed, and focused on shared aspirations.',
        ],
        'kullu' => [
            'name' => 'Kullu (Valley of Gods), Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Breathtaking Valley Vistas & Riverine Dates in Kullu',
            'intro' => 'Pine-forested river banks, apple orchards, and peaceful cafe nooks near Dhalpur ground offer an enchanting mountain setting for verified singles looking for authentic connections.',
            'popular_cafes' => ['River View Cafe Kullu', 'Apple Valley Bistro', 'Dhalpur Pine Brews', 'Himalayan Organic Cafe'],
            'safety_score' => '99.7%',
            'icon' => 'compass',
            'dating_tips' => 'Opt for early afternoon coffee dates overlooking the Beas river. Enjoy regional specialties like Siddu with hot espresso.',
        ],
        'hamirpur' => [
            'name' => 'Hamirpur, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Youthful Campus Vibes & Scenic Coffee Hubs in Hamirpur',
            'intro' => 'As the education hub of Himachal Pradesh (home to NIT Hamirpur), this vibrant town is filled with ambitious, tech-savvy singles who appreciate modern coffee culture and active lifestyles.',
            'popular_cafes' => ['Campus Coffee Corner', 'Pine Hill Roasters', 'Anu Valley Bistro', 'The Green Terrace Hamirpur'],
            'safety_score' => '99.9%',
            'icon' => 'graduation-cap',
            'dating_tips' => 'Great conversational chemistry comes naturally discussing campus memories, tech, startups, and creative hobbies over cold brew or cappuccino.',
        ],
        'bilaspur' => [
            'name' => 'Bilaspur, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Lakeside Waterside Dates Along Govind Sagar in Bilaspur',
            'intro' => 'Overlooking the vast azure waters of Govind Sagar Lake, Bilaspur provides picturesque lakefront terraces, cool breezes, and open-air cafes for unforgettable first dates.',
            'popular_cafes' => ['Govind Sagar Lake View Cafe', 'Waterfront Bistro Bilaspur', 'Luhnu Ground Promenade Lounge', 'Sutlej Breeze Cafe'],
            'safety_score' => '99.7%',
            'icon' => 'water',
            'dating_tips' => 'Meet at a lake-view terrace just before sunset. The shimmering golden water and quiet mountain perimeter make conversation effortless.',
        ],
        'una' => [
            'name' => 'Una, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Warm Hill-Gateway Coffee Meets & Easy Connections in Una',
            'intro' => 'As the vibrant gateway connecting Punjab and Himachal Pradesh, Una combines progressive urban ease with mountain warmth, offering bustling cafes and peaceful garden lounges.',
            'popular_cafes' => ['The Swan River Lounge', 'Gateway Coffee Club Una', 'Green Valley Bistro', 'Mall Road Beans'],
            'safety_score' => '99.6%',
            'icon' => 'road',
            'dating_tips' => 'A relaxed evening latte at an airy open cafe is ideal. Warm hospitality and genuine smiling conversation go a long way.',
        ],
        'chamba' => [
            'name' => 'Chamba, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Heritage Chaugan Promenades & Ancient Charm in Chamba',
            'intro' => 'Steeped in centuries of Pahari art and wooden temple history, Chamba’s famous green Chaugan grounds and Ravi River cliffs provide an atmospheric historic romance.',
            'popular_cafes' => ['Chaugan View Cafe', 'Ravi Riverside Bistro', 'Pahari Heritage Tea Lounge', 'Chamba Valley Brews'],
            'safety_score' => '99.9%',
            'icon' => 'palette',
            'dating_tips' => 'An afternoon stroll around the grassy Chaugan followed by coffee is traditional and timeless.',
        ],
        'palampur' => [
            'name' => 'Palampur, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Artisan Tea Estates & Pine Stream Dates in Palampur',
            'intro' => 'The tea capital of Northwest India features rolling emerald tea gardens, rushing Neugal Khad streams, and panoramic views of snow-crested Dhauladhar peaks.',
            'popular_cafes' => ['Neugal Cafe & Stream Lounge', 'The Tea Garden Veranda', 'Cliffhanger Cafe Bundla', 'Cloud9 Bistro Palampur'],
            'safety_score' => '99.9%',
            'icon' => 'seedling',
            'dating_tips' => 'Neugal Khad or a cafe nestled right into the tea bushes offers the most romantic scenery in Himachal for intentional singles.',
        ],
        'baddi' => [
            'name' => 'Baddi & Barotiwala, Himachal Pradesh',
            'state' => 'Himachal Pradesh',
            'region' => 'Himachal Pradesh',
            'headline' => 'Modern Corporate Singles & Post-Work Coffee Dates in Baddi',
            'intro' => 'Himachal’s premier industrial and pharmaceutical hub attracts young ambitious engineers, executives, and professionals seeking work-life balance and meaningful relationships.',
            'popular_cafes' => ['The Corporate Brew Baddi', 'City Center Espresso Bar', 'Hillside Retreat Lounge', 'Industrial Park Bistro'],
            'safety_score' => '99.6%',
            'icon' => 'briefcase',
            'dating_tips' => 'Ideal for relaxed evening coffees after office hours. Focus on weekend mountain getaways and creative passions outside work.',
        ],

        // ==========================================
        // 2. NORTH INDIA & TRI-CITY DATING HUBS
        // ==========================================
        'chandigarh' => [
            'name' => 'Chandigarh City Beautiful',
            'state' => 'Punjab & Haryana',
            'region' => 'North India',
            'headline' => 'Boulevard Specialty Cafes & Sukhna Lake Strolls in Chandigarh',
            'intro' => 'Tree-lined wide avenues, Le Corbusier modern architecture, Sector 9 courtyards, and open-air boulevard seating make Chandigarh India’s most orderly and pleasant dating city.',
            'popular_cafes' => ['Backyard Cafe Sector 9', 'Backpackers Cafe Sector 9', 'Books & Brew Sector 16', 'The Willow Cafe Sector 10'],
            'safety_score' => '99.8%',
            'icon' => 'leaf',
            'dating_tips' => 'Sector 9 or Sector 26 inner market cafes offer fantastic artisan coffee. A sunset walk at Sukhna Lake afterwards is the classic romantic follow-up.',
        ],
        'mohali' => [
            'name' => 'Mohali (SAS Nagar), Punjab',
            'state' => 'Punjab',
            'region' => 'North India',
            'headline' => 'Trendy Food Streets & Tech Singles in Mohali',
            'intro' => 'From the bustling neon-lit Phase 3B2 food street to upscale CP67 mall cafes, Mohali is home to vibrant entrepreneurs, techies, and modern Punjabi singles.',
            'popular_cafes' => ['Brew & Bake Phase 3B2', 'The Coffee Bean CP67', 'Cafe Nomad Mohali', 'Sector 70 Artisan Roastery'],
            'safety_score' => '99.7%',
            'icon' => 'building',
            'dating_tips' => 'Phase 3B2 is vibrant in the evening. Keep it light, fun, and enjoy fresh waffles and cold brews.',
        ],
        'delhi' => [
            'name' => 'Delhi NCR (Delhi, Gurgaon, Noida)',
            'state' => 'Delhi NCR',
            'region' => 'North India',
            'headline' => 'Champa Gali String Lights & Artisan Roasters in Delhi NCR',
            'intro' => 'From Saket’s Champa Gali fairy-lit paths to Hauz Khas Village ruins and CyberHub Gurgaon, connect with selfie-verified singles over craft pour-overs and cold brew tonics.',
            'popular_cafes' => ['CaPhe Roasters Saket', 'Blue Tokai Saidulajab', 'Colocal Dhan Mill Compound', 'Perch Wine & Coffee Bar Khan Market'],
            'safety_score' => '99.4%',
            'icon' => 'landmark',
            'dating_tips' => 'Choose daytime or early evening spots with metro connectivity like Dhan Mill or Champa Gali for low-pressure 45-minute meets.',
        ],
        'dehradun' => [
            'name' => 'Dehradun & Mussoorie Foothills',
            'state' => 'Uttarakhand',
            'region' => 'North India',
            'headline' => 'Rajpur Road Bakeries & Mountain Breezes in Dehradun',
            'intro' => 'Nestled in the Doon valley beneath Mussoorie, Dehradun’s Rajpur Road offers vintage bakeries, artisan wood-fired cafes, and cultured mountain singles.',
            'popular_cafes' => ['Cafe Canto Rajpur Road', 'First Gear Cafe Mussoorie Road', 'Sunburn Bistro', 'Ama Cafe Dehradun'],
            'safety_score' => '99.8%',
            'icon' => 'cloud-sun',
            'dating_tips' => 'An afternoon bakery meet along old Rajpur Road with cinnamon rolls and single-origin coffee is unbeatable.',
        ],

        // ==========================================
        // 3. MAJOR METRO CITIES IN INDIA
        // ==========================================
        'pune' => [
            'name' => 'Pune, Maharashtra',
            'state' => 'Maharashtra',
            'region' => 'Western India',
            'headline' => 'Specialty Roasteries & Courtyard Botanical Dates in Pune',
            'intro' => 'Koregaon Park, Kalyani Nagar, and FC Road offer the richest specialty coffee community in India, where verified singles meet at leafy botanical cafes.',
            'popular_cafes' => ['Blue Tokai Koregaon Park', 'Le Plaisir Deccan', 'One O Eight Cafe KP', 'Vohuman Cafe Dhole Patil'],
            'safety_score' => '99.8%',
            'icon' => 'mug-hot',
            'dating_tips' => 'Lane 6 in Koregaon Park is filled with serene garden seating. Enjoy artisan sourdough sandwiches and single-origin pour-overs.',
        ],
        'mumbai' => [
            'name' => 'Mumbai, Maharashtra',
            'state' => 'Maharashtra',
            'region' => 'Western India',
            'headline' => 'Bandra Heritage Bakehouses & Sea-Breeze Dates in Mumbai',
            'intro' => 'Escape the city rush with cozy 45-minute coffee dates across Bandra West, Kala Ghoda heritage lanes, and Juhu coastal cafes.',
            'popular_cafes' => ['Subko Coffee Roasters Bandra', 'Kala Ghoda Cafe Fort', 'Bastian Bandra', 'Prithvi Cafe Juhu'],
            'safety_score' => '99.6%',
            'icon' => 'city',
            'dating_tips' => 'Meet at Subko in Ranwar Village or an afternoon coffee at Prithvi Cafe with Irish coffees and cutting chai.',
        ],
        'bangalore' => [
            'name' => 'Bangalore, Karnataka',
            'state' => 'Karnataka',
            'region' => 'South India',
            'headline' => 'Garden City Specialty Cafes & Tech Innovators in Bangalore',
            'intro' => 'Indiranagar, Koramangala, and Lavelle Road host India’s most creative coffee roasters, combining single-origin micro-lot pour-overs with high-chemistry conversations.',
            'popular_cafes' => ['Araku Coffee 12th Main', 'Third Wave Roasters Koramangala', 'Brik Oven Indiranagar', 'The Hole in the Wall Cafe'],
            'safety_score' => '99.7%',
            'icon' => 'laptop',
            'dating_tips' => 'A weekend brunch date at Araku or Third Wave Coffee with pour-over tastings lets conversation flow effortlessly.',
        ],
        'jaipur' => [
            'name' => 'Jaipur, Rajasthan',
            'state' => 'Rajasthan',
            'region' => 'North India',
            'headline' => 'Pink City Heritage Cafes & Rooftop Dates in Jaipur',
            'intro' => 'C-Scheme and Malviya Nagar offer stunning rooftop cafe views, artisan bakeries, and cultured singles meeting over spiced teas and espresso.',
            'popular_cafes' => ['Tapri The Tea House C-Scheme', 'Curious Gull Malviya Nagar', 'Anokhi Cafe', 'Stepout Cafe & Book Lounge'],
            'safety_score' => '99.6%',
            'icon' => 'chess-rook',
            'dating_tips' => 'Tapri Central overlooking Central Park is ideal for watching the sunset with chai, herbal infusions, and warm banter.',
        ],
        'hyderabad' => [
            'name' => 'Hyderabad, Telangana',
            'state' => 'Telangana',
            'region' => 'South India',
            'headline' => 'Jubilee Hills Lakeside Cafes & Chic Dates in Hyderabad',
            'intro' => 'Boutique coffee roasters across Jubilee Hills Road 45 and Banjara Hills offer quiet courtyards and world-class brews for cosmopolitan singles.',
            'popular_cafes' => ['Roastery Coffee House Banjara Hills', 'Conçú Jubilee Hills', 'Last House Coffee Durgam Cheruvu', 'Feu Dessert Bar'],
            'safety_score' => '99.7%',
            'icon' => 'gem',
            'dating_tips' => 'Roastery Coffee House in Banjara Hills with its leafy colonial courtyard is Hyderabad’s #1 spot for first coffee dates.',
        ],
        'kolkata' => [
            'name' => 'Kolkata, West Bengal',
            'state' => 'West Bengal',
            'region' => 'East India',
            'headline' => 'Park Street Literary Cafes & Intellectual Romance in Kolkata',
            'intro' => 'From heritage College Street coffee houses to contemporary Southern Avenue roasteries, Kolkata offers unmatched warmth for soulful romantics.',
            'popular_cafes' => ['Sienna Store & Cafe Southern Ave', 'Roastery Coffee House Gariahat', 'Flurys Park Street', 'Indian Coffee House'],
            'safety_score' => '99.7%',
            'icon' => 'book',
            'dating_tips' => 'Sienna Cafe on Southern Avenue offers artistic pottery, handcrafted iced coffees, and great acoustic playlists for deep conversation.',
        ],
        'goa' => [
            'name' => 'Goa (Panjim, Assagao, Anjuna)',
            'state' => 'Goa',
            'region' => 'Western India',
            'headline' => 'Portuguese Villas & Bohemian Sunset Dates in Goa',
            'intro' => 'Assagao, Anjuna, and Fontainhas Latin Quarter provide slow, romantic cafe afternoons with verified singles surrounded by tropical gardens.',
            'popular_cafes' => ['Babka Goa Anjuna', 'Gulaebola Assagao', 'Caravela Cafe Fontainhas Panjim', 'Artjuna Anjuna'],
            'safety_score' => '99.7%',
            'icon' => 'umbrella-beach',
            'dating_tips' => 'Caravela Cafe in the historic Fontainhas Latin Quarter with authentic pastéis de nata and single estate espresso is pure romance.',
        ],
    ];

    public function index()
    {
        $cities = $this->cityData;
        $internationalCities = [
            'london' => 'London, United Kingdom',
            'dubai' => 'Dubai, United Arab Emirates',
            'toronto' => 'Toronto, Canada',
            'new-york' => 'New York, United States',
            'melbourne' => 'Melbourne, Australia',
            'singapore' => 'Singapore',
            'sydney' => 'Sydney, Australia',
        ];

        return view('pages.cities-index', compact('cities', 'internationalCities'));
    }

    public function show($slug)
    {
        $slug = strtolower(trim($slug));
        $city = $this->cityData[$slug] ?? null;

        if (!$city) {
            $international = [
                'london' => 'United Kingdom',
                'dubai' => 'United Arab Emirates',
                'toronto' => 'Canada',
                'new-york' => 'United States',
                'melbourne' => 'Australia',
                'singapore' => 'Singapore',
                'sydney' => 'Australia',
            ];
            $formattedName = ucwords(str_replace('-', ' ', $slug));
            $country = $international[$slug] ?? 'India';
            $city = [
                'name' => $formattedName . ', ' . $country,
                'state' => $country,
                'region' => $country === 'India' ? 'India' : 'International',
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
        } catch (\Throwable $e) {
            $singles = collect();
        }

        // Local cafe spots
        try {
            $cafes = DatePlace::where('city', 'like', "%{$slug}%")
                ->orWhere('city', 'like', "%{$cityNameOnly}%")
                ->take(4)
                ->get();
        } catch (\Throwable $e) {
            $cafes = collect();
        }

        // Fallback cafes if date places not seeded for small hill stations
        if ($cafes->isEmpty()) {
            $cafes = collect();
            foreach ($city['popular_cafes'] as $index => $cName) {
                $cafes->push((object)[
                    'id' => $index + 100,
                    'name' => $cName,
                    'type' => 'Curated Dating Partner Cafe',
                    'city' => $cityNameOnly,
                    'address' => $cityNameOnly . ', ' . $city['state'],
                    'cup_offer' => '15% Off Total Bill for CupDate Singles',
                    'rating' => 4.8 + ($index * 0.05),
                ]);
            }
        }

        // Related nearby cities in the same region
        $relatedCities = collect($this->cityData)
            ->filter(function($c, $k) use ($slug, $city) {
                return $k !== $slug && ($c['state'] === $city['state'] || $c['region'] === $city['region']);
            })
            ->take(4);

        return view('pages.city', compact('city', 'slug', 'singles', 'cafes', 'relatedCities'));
    }
}
