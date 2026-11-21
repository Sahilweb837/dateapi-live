@extends('layouts.app')

@section('title', 'Admin Blog Publishing Engine — CupDate')

@section('content')
<div class="min-h-screen bg-[#0b0f19] text-[#f1f5f9] font-['Plus_Jakarta_Sans',sans-serif] py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#1e293b]">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 rounded-xl bg-[#1e293b] hover:bg-[#334155] border border-[#334155] flex items-center justify-center text-white transition">
                    &larr;
                </a>
                <div>
                    <h1 class="font-extrabold text-2xl text-white">
                        Editorial Blog Engine
                    </h1>
                    <p class="text-xs text-[#94a3b8] mt-0.5">Publish high-value SEO articles and dating guides to boost Google Search rankings.</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('sitemap.xml') }}" target="_blank" class="px-3.5 py-2 bg-[#1e293b] hover:bg-[#334155] border border-[#334155] text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                    <span>🗺️</span> View Sitemap.xml
                </a>
                <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 bg-[#b0284b] hover:bg-[#97223f] text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                    Command Center &rarr;
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-950/80 border border-emerald-500/40 rounded-2xl text-xs font-bold text-emerald-300 flex items-center gap-2">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 p-4 bg-rose-950/80 border border-rose-500/40 rounded-2xl text-xs font-bold text-rose-300">
                <span>⚠</span> {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- New Article Form -->
            <div class="lg:col-span-1 bg-[#111827] border border-[#1f2937] rounded-2xl p-6">
                <h2 class="font-extrabold text-base text-white mb-2">Publish New Article</h2>
                
                <div class="mb-4 p-3 bg-[#1e293b] border border-[#334155] rounded-xl text-xs text-[#cbd5e1] leading-relaxed">
                    ✨ <strong>Automatic SEO Sync</strong>: The title, clean slug, excerpt, and body are instantly linked to Google Search Console and the live XML sitemap.
                </div>

                <form action="{{ route('admin.blogs.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-[#94a3b8] mb-1">Article Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required maxlength="255" placeholder="e.g. 5 Best Cafes for First Dates in Shimla" class="w-full bg-[#1e293b] border border-[#334155] rounded-xl px-3 py-2 text-xs text-white placeholder-[#64748b] focus:outline-none focus:border-[#ff6584]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#94a3b8] mb-1">Category</label>
                        <select name="category" class="w-full bg-[#1e293b] border border-[#334155] rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#ff6584]">
                            <option value="Dating Etiquette">Dating Etiquette</option>
                            <option value="Safety Tips">Safety Tips</option>
                            <option value="City Dating Guides">City Dating Guides</option>
                            <option value="Relationship Advice">Relationship Advice</option>
                            <option value="Coffee Culture">Coffee Culture</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#94a3b8] mb-1">Short Excerpt (Meta Description)</label>
                        <textarea name="excerpt" rows="2" maxlength="500" placeholder="Brief summary of the article for Google search snippets..." class="w-full bg-[#1e293b] border border-[#334155] rounded-xl px-3 py-2 text-xs text-white placeholder-[#64748b] focus:outline-none focus:border-[#ff6584] resize-none">{{ old('excerpt') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#94a3b8] mb-1">Full Article Content</label>
                        <textarea name="content" rows="6" required placeholder="Write your full guide here..." class="w-full bg-[#1e293b] border border-[#334155] rounded-xl px-3 py-2 text-xs text-white placeholder-[#64748b] focus:outline-none focus:border-[#ff6584] resize-none">{{ old('content') }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#b0284b] to-[#ff6584] hover:brightness-105 text-white font-extrabold rounded-xl text-xs transition cursor-pointer shadow-md shadow-[#b0284b]/20">
                        Publish &amp; Update Sitemap &rarr;
                    </button>
                </form>
            </div>

            <!-- Existing Articles Directory -->
            <div class="lg:col-span-2 bg-[#111827] border border-[#1f2937] rounded-2xl p-6">
                <h2 class="font-extrabold text-base text-white mb-4">
                    Published Editorial Articles ({{ $blogs->count() }})
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-[#1f2937] text-[10px] uppercase tracking-wider text-[#94a3b8]">
                                <th class="pb-3">Title</th>
                                <th class="pb-3">Category</th>
                                <th class="pb-3">SEO Slug</th>
                                <th class="pb-3">Date</th>
                                <th class="pb-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1f2937]">
                            @forelse($blogs as $b)
                                <tr class="hover:bg-[#1e293b]/40 transition">
                                    <td class="py-3 font-bold text-white max-w-[180px] truncate">{{ $b->title }}</td>
                                    <td class="py-3 text-[#ff6584] font-semibold">{{ $b->category }}</td>
                                    <td class="py-3 text-[#94a3b8] font-mono text-[11px]">{{ $b->slug }}</td>
                                    <td class="py-3 text-[#64748b]">{{ $b->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('blog.show', $b->slug) }}" target="_blank" class="text-emerald-400 font-bold hover:underline">
                                            View Live &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-[#64748b]">No articles published yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
