<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class SitemapController extends Controller
{
    protected $cities = [
        'shimla' => 'Shimla, Himachal Pradesh',
        'manali' => 'Manali, Himachal Pradesh',
        'dharamshala' => 'Dharamshala & McLeodGanj',
        'kasauli' => 'Kasauli & Solan',
        'pune' => 'Pune, Maharashtra',
        'mumbai' => 'Mumbai, Maharashtra',
        'bangalore' => 'Bangalore, Karnataka',
        'delhi' => 'Delhi NCR',
        'chandigarh' => 'Chandigarh Tricity',
        'jaipur' => 'Jaipur, Rajasthan',
        'goa' => 'Goa Beachside',
    ];

    protected function getSafeBlogs()
    {
        try {
            return Blog::orderBy('created_at', 'desc')->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Sitemap Blog query fallback due to database connection: ' . $e->getMessage());
            return collect([
                (object)[
                    'slug' => 'ultimate-coffee-dating-etiquette-india-2026',
                    'title' => 'Ultimate Coffee Dating Etiquette Guide (2026)',
                    'created_at' => now(),
                ],
                (object)[
                    'slug' => 'women-dating-safety-guide-india',
                    'title' => "Women's Dating Safety Guide for India",
                    'created_at' => now(),
                ],
                (object)[
                    'slug' => 'romantic-coffee-date-guide-himachal-pradesh',
                    'title' => 'The Mountain Romance Guide: Coffee Dates in Shimla & Manali',
                    'created_at' => now(),
                ],
            ]);
        }
    }

    public function xml()
    {
        $blogs = $this->getSafeBlogs();
        $cities = array_keys($this->cities);

        return response()->view('sitemap.xml', [
            'blogs' => $blogs,
            'cities' => $cities,
        ])->header('Content-Type', 'text/xml');
    }

    public function html()
    {
        $blogs = $this->getSafeBlogs();
        $cities = $this->cities;

        return view('sitemap.html', compact('blogs', 'cities'));
    }
}
