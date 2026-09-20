@extends('layouts.app')

@section('title', 'Admin Blog Engine — CupDate')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d]">
                Admin Blog Publishing Engine
            </h1>
            <p class="text-xs text-[#7a666c] mt-1">Publish editorial articles to boost SEO and meet AdSense High-Value Content standards.</p>
        </div>
        <a href="{{ route('sitemap.xml') }}" target="_blank" class="px-3.5 py-2 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] rounded-xl text-xs font-bold hover:bg-[#ede2d8] transition flex items-center gap-1.5 shadow-none">
            <i class="fa-solid fa-sitemap"></i> View Sitemap.xml
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center gap-2 shadow-none">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-xs font-bold text-rose-800">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- New Article Form -->
        <div class="lg:col-span-1 bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-3">Publish Article</h2>
            
            <div class="mb-4 p-3 bg-[#f5ede6] border border-[#e5d5ca] rounded-xl text-[11px] text-[#8b5a2b] leading-relaxed shadow-none">
            <i class="fa-solid fa-magic mr-1"></i> <strong>Simple publishing</strong>: Enter the title and article text. The public blog page and sitemap use the saved article automatically.
            </div>

            <form action="{{ route('admin.blogs.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Article Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required maxlength="255" placeholder="e.g. 5 Best Cafes for First Dates in Bangalore" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Category</label>
                    <select name="category" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        <option value="Dating Etiquette">Dating Etiquette</option>
                        <option value="Safety Tips">Safety Tips</option>
                        <option value="City Dating Guides">City Dating Guides</option>
                        <option value="Relationship Advice">Relationship Advice</option>
                        <option value="Coffee Culture">Coffee Culture</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Short Excerpt</label>
                    <textarea name="excerpt" rows="2" maxlength="500" placeholder="Brief summary of the article for Google search snippets..." class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b] resize-none">{{ old('excerpt') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Full Article Body</label>
                    <textarea name="content" rows="6" required placeholder="Write your full guide here..." class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b] resize-none">{{ old('content') }}</textarea>
                </div>

                <button type="submit" class="w-full py-3 bg-[#8b5a2b] text-white font-extrabold rounded-xl text-xs hover:bg-[#6d441e] transition cursor-pointer shadow-none">
                    <i class="fa-solid fa-paper-plane mr-1"></i> Publish & Update Sitemap
                </button>
            </form>
        </div>

        <!-- Existing Articles Directory -->
        <div class="lg:col-span-2 bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-4">
                Published Articles ({{ $blogs->count() }})
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#e5d5ca] text-[11px] uppercase tracking-wider text-[#7a666c]">
                            <th class="pb-3">Title</th>
                            <th class="pb-3">Category</th>
                            <th class="pb-3">Generated Slug</th>
                            <th class="pb-3">Date</th>
                            <th class="pb-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e5d5ca] text-xs">
                        @forelse($blogs as $b)
                            <tr>
                                <td class="py-3 font-bold text-[#24140d] max-w-[180px] truncate">{{ $b->title }}</td>
                                <td class="py-3 text-[#8b5a2b] font-semibold">{{ $b->category }}</td>
                                <td class="py-3 text-[#7a666c] font-mono text-[11px]">{{ $b->slug }}</td>
                                <td class="py-3 text-[#7a666c]">{{ $b->created_at->format('M d, Y') }}</td>
                                <td class="py-3 text-right">
                                    <a href="{{ route('blog.show', $b->slug) }}" target="_blank" class="text-[#8b5a2b] font-bold hover:underline">
                                        View →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-[#7a666c]">No articles published in database yet. Use the form on the left!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
