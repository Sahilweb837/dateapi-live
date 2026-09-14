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

        // Write standalone physical PHP file to root blog/ folder for legacy compatibility
        $this->generatePhysicalBlogFile($blog);

        // Update sitemap.xml automatically
        $this->appendUrlToSitemap("https://cupdate.in/blog/{$slug}");

        return redirect()->route('admin.blogs')->with('success', "Blog article '{$blog->title}' published with auto-generated slug '{$slug}' and added to sitemap.xml!");
    }

    private function generatePhysicalBlogFile(Blog $blog)
    {
        $rootBlogDir = base_path('../blog');
        if (!is_dir($rootBlogDir)) {
            @mkdir($rootBlogDir, 0755, true);
        }

        $filePath = "{$rootBlogDir}/{$blog->slug}.php";
        $pageTitle = addslashes($blog->title) . " — CupDate";
        $metaDesc = addslashes($blog->excerpt);
        $canonicalUrl = "https://cupdate.in/blog/{$blog->slug}";

        $phpContent = <<<PHP
<?php
\$page_title = "{$pageTitle}";
\$meta_desc = "{$metaDesc}";
\$canonical_url = "{$canonicalUrl}";
\$schema_json = json_encode([
    "@context" => "https://schema.org",
    "@type" => "Article",
    "headline" => \$page_title,
    "description" => \$meta_desc,
    "mainEntityOfPage" => \$canonicalUrl,
    "datePublished" => "{$blog->created_at->toIso8601String()}",
    "publisher" => [
        "@type" => "Organization",
        "name" => "CupDate",
        "logo" => ["@type" => "ImageObject", "url" => "https://cupdate.in/assets/images/cupdate_logo.svg"]
    ]
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

require_once __DIR__ . '/../includes/header.php';
?>
<main style="max-width:860px;margin:40px auto;padding:0 20px;font-family:'Inter',sans-serif;color:#1c1b1b;line-height:1.8;">
    <span style="background:#fff0f5;color:#ff4d79;border:1px solid #f2dbe3;padding:5px 14px;border-radius:999px;font-size:13px;font-weight:700;">{$blog->category}</span>
    <h1 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:2.4rem;font-weight:800;margin:16px 0;color:#1a1517;">{$blog->title}</h1>
    <p style="color:#7a666c;font-size:14px;margin-bottom:30px;">Published {$blog->created_at->format('F d, Y')}</p>
    <div style="font-size:1.1rem;color:#2b2326;">
        {$blog->content}
    </div>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
PHP;

        @file_put_contents($filePath, $phpContent);
    }

    private function appendUrlToSitemap($url)
    {
        $sitemapPath = base_path('../sitemap.xml');
        if (file_exists($sitemapPath)) {
            $content = file_get_contents($sitemapPath);
            if (strpos($content, $url) === false) {
                $today = date('Y-m-d');
                $newEntry = "  <url>\n    <loc>{$url}</loc>\n    <lastmod>{$today}</lastmod>\n    <changefreq>weekly</changefreq>\n    <priority>0.80</priority>\n  </url>\n</urlset>";
                $content = str_replace('</urlset>', $newEntry, $content);
                @file_put_contents($sitemapPath, $content);
            }
        }
    }
}
