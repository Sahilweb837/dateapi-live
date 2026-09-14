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

    public function xml()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        $cities = array_keys($this->cities);

        return response()->view('sitemap.xml', [
            'blogs' => $blogs,
            'cities' => $cities,
        ])->header('Content-Type', 'text/xml');
    }

    public function html()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        $cities = $this->cities;

        return view('sitemap.html', compact('blogs', 'cities'));
    }
}
