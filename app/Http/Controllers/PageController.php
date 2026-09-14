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
        $query = DatePlace::query();

        if ($city) {
            $query->where('city', 'like', "%{$city}%");
        }

        $places = $query->orderBy('rating', 'desc')->get();
        $cities = DatePlace::select('city')->distinct()->pluck('city');

        return view('pages.dates', compact('places', 'cities', 'city'));
    }

    public function rishta()
    {
        $featuredSingles = User::where('status', 'active')
            ->where('is_verified', 1)
            ->take(8)
            ->get();

        return view('pages.rishta', compact('featuredSingles'));
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

