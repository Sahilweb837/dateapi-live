{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- ═══════════════════════════════════════════════════════
         TIER 1 — CORE APPLICATION & DATING HUBS (Priority 1.0 - 0.90)
    ═══════════════════════════════════════════════════════ -->
    <url>
        <loc>https://cupdate.in/</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://cupdate.in/feed</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.95</priority>
    </url>
    <url>
        <loc>https://cupdate.in/swipes</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.95</priority>
    </url>
    <url>
        <loc>https://cupdate.in/dates</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>https://cupdate.in/rishta</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>https://cupdate.in/video</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.85</priority>
    </url>

    <!-- ═══════════════════════════════════════════════════════
         TIER 2 — CITY DATING HUBS & HIMACHAL PRADESH
    ═══════════════════════════════════════════════════════ -->
    <url>
        <loc>https://cupdate.in/cities</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    @foreach($cities as $citySlug)
    <url>
        <loc>https://cupdate.in/city/{{ $citySlug }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.85</priority>
    </url>
    @endforeach

    <!-- ═══════════════════════════════════════════════════════
         TIER 3 — INTERACTIVE TOOLS & GUIDES
    ═══════════════════════════════════════════════════════ -->
    <url>
        <loc>https://cupdate.in/ai-bio-generator</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.85</priority>
    </url>
    <url>
        <loc>https://cupdate.in/coffee-date-ideas</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.85</priority>
    </url>
    <url>
        <loc>https://cupdate.in/blog</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.85</priority>
    </url>

    <!-- ═══════════════════════════════════════════════════════
         TIER 4 — GOOGLE ADSENSE E-E-A-T & LEGAL COMPLIANCE
    ═══════════════════════════════════════════════════════ -->
    <url>
        <loc>https://cupdate.in/about</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/contact</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/privacy</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/terms</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/safety</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/community-guidelines</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/cookie-policy</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/faq</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/how-it-works</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/disclaimer</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://cupdate.in/sitemap</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.70</priority>
    </url>

    <!-- ═══════════════════════════════════════════════════════
         TIER 5 — DYNAMIC EDITORIAL BLOGS & GUIDES
    ═══════════════════════════════════════════════════════ -->
    @foreach($blogs as $blog)
    <url>
        <loc>https://cupdate.in/blog/{{ $blog->slug }}</loc>
        <lastmod>{{ $blog->created_at ? $blog->created_at->format('Y-m-d') : now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    @endforeach
</urlset>
