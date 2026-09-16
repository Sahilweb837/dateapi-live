<!-- Reusable Wireframe Skeleton Shimmer (Matching Exact Specification) -->
<div class="cupdate-wireframe-skeleton w-full max-w-[1360px] mx-auto p-4 sm:p-6 transition-opacity duration-500">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
        
        <!-- Column 1 (Left Stack) -->
        <div class="flex flex-col gap-6">
            <!-- Card 1A: Media + Pill + Actions -->
            <div class="bg-white/80 rounded-2xl p-5 border border-outline-variant/30 shadow-xs flex flex-col gap-4">
                <div class="w-full h-44 rounded-xl skeleton-shimmer"></div>
                <div class="flex items-center justify-between pt-1">
                    <div class="flex flex-col gap-2">
                        <div class="h-3.5 w-24 rounded-full skeleton-shimmer"></div>
                        <div class="h-2.5 w-16 rounded-full skeleton-shimmer"></div>
                    </div>
                    <div class="h-8 w-28 rounded-full skeleton-shimmer"></div>
                </div>
            </div>

            <!-- Card 1B: Multi-line Content + Full Pill Button -->
            <div class="bg-white/80 rounded-2xl p-5 border border-outline-variant/30 shadow-xs flex flex-col gap-3">
                <div class="h-3.5 w-4/5 rounded-full skeleton-shimmer"></div>
                <div class="h-3 w-1/3 rounded-full skeleton-shimmer"></div>
                <div class="h-3 w-3/5 rounded-full skeleton-shimmer"></div>
                <div class="h-9 w-full rounded-full skeleton-shimmer mt-3"></div>
            </div>
        </div>

        <!-- Column 2 (Center Hero Stack) -->
        <div class="bg-white/80 rounded-2xl p-5 border border-outline-variant/30 shadow-xs flex flex-col gap-4">
            <!-- Header with Avatar & Details -->
            <div class="flex items-center justify-between pb-2 border-b border-outline-variant/20">
                <div class="flex flex-col gap-2">
                    <div class="h-3.5 w-36 rounded-full skeleton-shimmer"></div>
                    <div class="h-2.5 w-24 rounded-full skeleton-shimmer"></div>
                </div>
                <div class="w-12 h-12 rounded-full skeleton-shimmer shrink-0"></div>
            </div>
            <!-- Large Portrait Stage -->
            <div class="w-full h-[400px] rounded-xl skeleton-shimmer"></div>
        </div>

        <!-- Column 3 (Right Feature Stack) -->
        <div class="flex flex-col gap-6">
            <!-- Card 3A: Pill Header + Media Block + Bars -->
            <div class="bg-white/80 rounded-2xl p-5 border border-outline-variant/30 shadow-xs flex flex-col gap-4">
                <div class="h-6 w-36 rounded-full skeleton-shimmer"></div>
                <div class="w-full h-32 rounded-xl skeleton-shimmer"></div>
                <div class="flex flex-col gap-2 pt-1">
                    <div class="h-3 w-28 rounded-full skeleton-shimmer"></div>
                    <div class="h-2.5 w-40 rounded-full skeleton-shimmer"></div>
                </div>
            </div>

            <!-- Card 3B: Thumbnail + Text + Pill Button -->
            <div class="bg-white/80 rounded-2xl p-5 border border-outline-variant/30 shadow-xs flex items-center gap-4">
                <div class="w-24 h-24 rounded-xl skeleton-shimmer shrink-0"></div>
                <div class="flex flex-col justify-between h-24 flex-1 py-1">
                    <div class="flex flex-col gap-2">
                        <div class="h-3.5 w-28 rounded-full skeleton-shimmer"></div>
                        <div class="h-2.5 w-20 rounded-full skeleton-shimmer"></div>
                    </div>
                    <div class="h-7 w-24 rounded-full skeleton-shimmer"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.skeleton-shimmer {
    background: linear-gradient(90deg, #f0e6e1 25%, #faf3f0 50%, #f0e6e1 75%);
    background-size: 200% 100%;
    animation: cupdateShimmer 1.5s infinite;
}
@keyframes cupdateShimmer {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
</style>
