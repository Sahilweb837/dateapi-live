<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blogs', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image_icon' => 'nullable|string|max:50',
        ]);

        // Auto-generate slug from title (no manual slug input required)
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $counter = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $counter++;
            $slug = "{$baseSlug}-{$counter}";
        }

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category ?? 'Dating Advice',
            'excerpt' => $request->excerpt ?? Str::limit(strip_tags($request->content), 180),
            'content' => $request->content,
            'image_icon' => $request->image_icon ?? 'fa-heart',
            'created_at' => now(),
        ]);

        return redirect()->route('admin.blogs')->with('success', "Blog article '{$blog->title}' published successfully.");
    }
}
