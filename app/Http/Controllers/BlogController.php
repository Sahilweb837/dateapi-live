<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blog::orderBy('created_at', 'desc')->paginate(12);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Blog index fallback: ' . $e->getMessage());
            $blogs = $this->getFallbackBlogs();
        }

        return view('blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        try {
            $blog = Blog::where('slug', $slug)->first();
        } catch (\Throwable $e) {
            $blog = null;
        }

        if (!$blog) {
            $blog = $this->getFallbackBlogs()->firstWhere('slug', $slug) ?? $this->getFallbackBlogs()->first();
        }

        return view('blog.show', compact('blog'));
    }

    protected function getFallbackBlogs()
    {
        return collect([
            (object)[
                'id' => 1,
                'slug' => 'ultimate-coffee-dating-etiquette-india-2026',
                'title' => 'Ultimate Coffee Dating Etiquette Guide (2026)',
                'category' => 'Dating Advice',
                'excerpt' => 'The complete handbook on navigating first dates over specialty coffee: who pays, how long to stay, and conversational green flags.',
                'content' => "Coffee dates have rapidly evolved into India's preferred first encounter for modern dating and matrimonial pre-meets. Unlike rigid dinners or noisy clubs, a 45-minute specialty pour-over provides a warm, low-pressure setting where genuine chemistry can unfold naturally.\n\n### The Golden 45-Minute Window\nOne of the greatest benefits of a coffee date is its flexible timeframe. If the vibe is awkward, a 45-minute single cappuccino allows a graceful exit with zero hard feelings. If sparks fly, ordering a second round or taking a stroll along the promenade is effortless.\n\n### Specialty Venues vs. Generic Chains\nOpt for independent roasteries like Blue Tokai, Subko, Wake & Bake, or Illiterati Books. The artisanal atmosphere, soft acoustic playlist, and fragrant roast profile create an immediate conversation piece.",
                'image_icon' => 'fa-mug-hot',
                'views' => 1420,
                'created_at' => now(),
            ],
            (object)[
                'id' => 2,
                'slug' => 'women-dating-safety-guide-india',
                'title' => "Women's Dating Safety Guide for India (DPDP Act 2026)",
                'category' => 'Safety & Trust',
                'excerpt' => 'Essential security protocols, location sharing, verification badges, and reporting mechanisms for peace of mind.',
                'content' => "At CupDate, women's safety is our foundational design principle. With end-to-end user verification, government-compliant data protection (DPDP Act 2023), and AI-monitored photo moderation, here is how you can date with absolute confidence.\n\n### 1. Always Meet in Vetted Public Cafes\nNever agree to private residences or secluded locations on a first meet. Choose verified CupDate partner cafes with active foot traffic and attentive staff.\n\n### 2. Guard Your Phone Number with CupDate In-App Chat\nKeep your personal phone number, WhatsApp, and social media handles private until you have met in person and verified mutual comfort. Our in-app real-time chat supports secure photo attachments and instant moderation without exposing personal contact details.",
                'image_icon' => 'fa-shield-halved',
                'views' => 2180,
                'created_at' => now(),
            ],
            (object)[
                'id' => 3,
                'slug' => 'romantic-coffee-date-guide-himachal-pradesh',
                'title' => 'The Mountain Romance Guide: Coffee Dates in Shimla & Manali',
                'category' => 'Himachal Dating',
                'excerpt' => 'Discover quiet colonial verandas in Shimla, riverside patios in Old Manali, and literary retreats in McLeodGanj.',
                'content' => "There is something uniquely magical about sharing hot espresso while wrapped in a woolen shawl overlooking snow-dusted Himalayan peaks. Himachal Pradesh offers the most atmospheric dating backdrop in the subcontinent.\n\nFrom the century-old woodcraft of Shimla's Mall Road to the artistic cafes along the rushing Manalsu river in Old Manali, discover our curated guide to mountain coffee dating.",
                'image_icon' => 'fa-mountain',
                'views' => 950,
                'created_at' => now(),
            ],
        ]);
    }
}
