@extends('layouts.app')

@section('title', 'AI Dating Bio Generator — CupDate Specialty Coffee Matchmaking')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-b from-[#f5ede6] to-[#fbf8f5] py-16 border-b border-[#e5d5ca]">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="inline-flex items-center gap-2 text-xs font-semibold text-[#8b5a2b] uppercase tracking-wider">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li class="text-[#c4a482]">/</li>
                <li class="text-[#4a383e]">AI Bio Generator</li>
            </ol>
        </nav>
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#f0e6dc] border border-[#d6c2b4] text-[#8b5a2b] text-xs font-bold uppercase tracking-wider mb-4 shadow-none">
            <i class="fa-solid fa-wand-magic-sparkles"></i> 100% Free Smart Bio Writer
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[#24140d] tracking-tight mb-4">
            Craft Your Perfect <span class="text-[#8b5a2b]">Coffee Dating Bio</span>
        </h1>
        <p class="font-['Inter'] text-sm sm:text-base text-[#6b554b] max-w-2xl mx-auto leading-relaxed">
            Stuck on what to write? Our intelligent dating profile generator blends your favorite brew, passions, and unique personality vibe into high-converting dating bios.
        </p>
    </div>
</section>

<!-- Interactive Generator Tool -->
<section class="py-16 bg-[#fbf8f5]">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 sm:p-10 shadow-none">
            
            <form id="bioForm" onsubmit="event.preventDefault(); generateBio();" class="space-y-6">
                <!-- Name & City -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="bioName" class="block font-['Plus_Jakarta_Sans'] font-bold text-xs uppercase tracking-wider text-[#4a383e] mb-2">
                            Your First Name
                        </label>
                        <input type="text" id="bioName" placeholder="e.g. Tanya or Kabir" required
                               class="w-full px-4 py-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl text-sm text-[#24140d] focus:outline-none focus:border-[#8b5a2b] shadow-none">
                    </div>
                    <div>
                        <label for="bioCity" class="block font-['Plus_Jakarta_Sans'] font-bold text-xs uppercase tracking-wider text-[#4a383e] mb-2">
                            Your City / Location
                        </label>
                        <input type="text" id="bioCity" placeholder="e.g. Shimla, Pune, Mumbai"
                               class="w-full px-4 py-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl text-sm text-[#24140d] focus:outline-none focus:border-[#8b5a2b] shadow-none">
                    </div>
                </div>

                <!-- Coffee Style -->
                <div>
                    <label for="bioCoffee" class="block font-['Plus_Jakarta_Sans'] font-bold text-xs uppercase tracking-wider text-[#4a383e] mb-2">
                        Your Go-To Coffee Order
                    </label>
                    <select id="bioCoffee" class="w-full px-4 py-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl text-sm text-[#24140d] focus:outline-none focus:border-[#8b5a2b] shadow-none">
                        <option value="Vanilla Oat Latte">Vanilla Oat Latte (Smooth & warm)</option>
                        <option value="Artisanal Pour-Over">Artisanal Pour-Over (Mindful & intentional)</option>
                        <option value="Double Espresso">Double Espresso (Bold, sharp & energetic)</option>
                        <option value="Cold Brew with Sea Salt Foam">Cold Brew with Sea Salt Foam (Chill & modern)</option>
                        <option value="Cinnamon Honey Cappuccino">Cinnamon Honey Cappuccino (Sweet & romantic)</option>
                        <option value="Masala Chai or Filter Kaapi">Masala Chai or South Indian Filter Kaapi (Traditional & soulful)</option>
                    </select>
                </div>

                <!-- Interests -->
                <div>
                    <label for="bioInterests" class="block font-['Plus_Jakarta_Sans'] font-bold text-xs uppercase tracking-wider text-[#4a383e] mb-2">
                        3 Things You Love (Comma separated)
                    </label>
                    <input type="text" id="bioInterests" placeholder="e.g. cedar mountain trails, vinyl records, indie movies"
                           class="w-full px-4 py-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl text-sm text-[#24140d] focus:outline-none focus:border-[#8b5a2b] shadow-none">
                </div>

                <!-- Vibe Selection -->
                <div>
                    <label class="block font-['Plus_Jakarta_Sans'] font-bold text-xs uppercase tracking-wider text-[#4a383e] mb-3">
                        Choose Your Dating Vibe
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="vibeContainer">
                        <label class="flex items-center gap-2 p-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl cursor-pointer hover:border-[#8b5a2b] text-xs font-semibold text-[#4a383e]">
                            <input type="radio" name="vibe" value="witty" checked class="accent-[#8b5a2b]">
                            <span>😄 Witty & Charming</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl cursor-pointer hover:border-[#8b5a2b] text-xs font-semibold text-[#4a383e]">
                            <input type="radio" name="vibe" value="romantic" class="accent-[#8b5a2b]">
                            <span>🕯️ Sweet & Romantic</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl cursor-pointer hover:border-[#8b5a2b] text-xs font-semibold text-[#4a383e]">
                            <input type="radio" name="vibe" value="mountain" class="accent-[#8b5a2b]">
                            <span>🏔️ Mountain Wanderer</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl cursor-pointer hover:border-[#8b5a2b] text-xs font-semibold text-[#4a383e]">
                            <input type="radio" name="vibe" value="artsy" class="accent-[#8b5a2b]">
                            <span>🎨 Creative & Artsy</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl cursor-pointer hover:border-[#8b5a2b] text-xs font-semibold text-[#4a383e]">
                            <input type="radio" name="vibe" value="serious" class="accent-[#8b5a2b]">
                            <span>💍 Rishta & Soulmate</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 bg-[#fcfaf7] border border-[#e5d5ca] rounded-xl cursor-pointer hover:border-[#8b5a2b] text-xs font-semibold text-[#4a383e]">
                            <input type="radio" name="vibe" value="chill" class="accent-[#8b5a2b]">
                            <span>🌿 Low-Key & Chill</span>
                        </label>
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-4 bg-[#8b5a2b] hover:bg-[#704822] text-white font-['Plus_Jakarta_Sans'] font-bold text-sm uppercase tracking-wider rounded-xl transition-all shadow-none flex items-center justify-center gap-2">
                    <i class="fa-solid fa-sparkles"></i> Generate 3 Tailored Bios
                </button>
            </form>

            <!-- Results Display Area -->
            <div id="resultsWrapper" class="hidden mt-10 pt-8 border-t border-[#e5d5ca] space-y-4">
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] flex items-center gap-2">
                    <i class="fa-solid fa-check-double text-[#8b5a2b]"></i> Pick Your Favorite Bio
                </h3>

                <div id="bioCard1" class="p-5 bg-[#fcfaf7] border border-[#e5d5ca] rounded-2xl relative group">
                    <p id="bioText1" class="font-['Inter'] text-sm text-[#4a383e] leading-relaxed mb-3"></p>
                    <button onclick="copyGeneratedBio('bioText1', this)" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#8b5a2b] text-white text-xs font-bold rounded-lg hover:bg-[#704822] transition-colors">
                        <i class="fa-regular fa-copy"></i> <span>Copy Bio</span>
                    </button>
                </div>

                <div id="bioCard2" class="p-5 bg-[#fcfaf7] border border-[#e5d5ca] rounded-2xl relative group">
                    <p id="bioText2" class="font-['Inter'] text-sm text-[#4a383e] leading-relaxed mb-3"></p>
                    <button onclick="copyGeneratedBio('bioText2', this)" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#8b5a2b] text-white text-xs font-bold rounded-lg hover:bg-[#704822] transition-colors">
                        <i class="fa-regular fa-copy"></i> <span>Copy Bio</span>
                    </button>
                </div>

                <div id="bioCard3" class="p-5 bg-[#fcfaf7] border border-[#e5d5ca] rounded-2xl relative group">
                    <p id="bioText3" class="font-['Inter'] text-sm text-[#4a383e] leading-relaxed mb-3"></p>
                    <button onclick="copyGeneratedBio('bioText3', this)" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#8b5a2b] text-white text-xs font-bold rounded-lg hover:bg-[#704822] transition-colors">
                        <i class="fa-regular fa-copy"></i> <span>Copy Bio</span>
                    </button>
                </div>

                <div class="p-4 bg-[#f5ede6] border border-[#d6c2b4] rounded-2xl text-xs text-[#6b554b] flex items-center justify-between">
                    <span>Ready to update your profile?</span>
                    <a href="{{ route('profile') }}" class="font-bold text-[#8b5a2b] hover:underline flex items-center gap-1">
                        Go to Profile <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
function generateBio() {
    const name = document.getElementById('bioName').value.trim() || 'I';
    const city = document.getElementById('bioCity').value.trim() || 'India';
    const coffee = document.getElementById('bioCoffee').value;
    const rawInterests = document.getElementById('bioInterests').value.trim();
    const vibe = document.querySelector('input[name="vibe"]:checked').value;

    const list = rawInterests ? rawInterests.split(',').map(s => s.trim()).filter(Boolean) : ['good conversation', 'acoustic tracks', 'hidden cafes'];
    const p1 = list[0] || 'good music';
    const p2 = list[1] || 'artisan bakeries';
    const p3 = list[2] || 'weekend strolls';

    let bios = [];

    if (vibe === 'witty') {
        bios = [
            `Hi, I'm ${name} from ${city}. Powered by ${coffee} and a stubborn belief that pineapple on pizza is a crime. If you can debate ${p1} without taking it personally, first coffee is on me. ☕✨`,
            `Currently looking for someone who appreciates ${p2} as much as I appreciate quiet cafe corners. In a city like ${city}, finding good coffee is easy—finding genuine chemistry is rare. Let's change that.`,
            `Status: ${coffee} enthusiast, part-time ${p1} aficionado, full-time believer in 45-minute zero-pressure first dates. Let's skip the small talk and compare Spotify wrapped.`
        ];
    } else if (vibe === 'romantic') {
        bios = [
            `I'm ${name}, based in ${city}. A firm believer in handwritten notes, slow jazz, and long talks over ${coffee}. Looking for someone who values loyalty and gentle depth over fleeting noise. 🕯️`,
            `My ideal Sunday in ${city}: a sunny morning spot, fresh pour-overs, and discovering ${p1} together. Here for heartfelt laughs and authentic companionship.`,
            `Believer in slow mornings and meaningful eye contact. You'll usually find me lost in ${p2} with a cup of ${coffee}. Looking for my person.`
        ];
    } else if (vibe === 'mountain') {
        bios = [
            `Living for pine-scented mountain air, spontaneous road trips, and hot ${coffee} on misty mornings in ${city}. If you'd rather hike up for sunset than sit in city traffic, say hi! 🏔️☕`,
            `${name} here. Big fan of rustic wooden cafes, ${p1}, and snow-dusted ridges. Looking for an adventure buddy who can keep up with quiet trails and loud laughs.`,
            `Himalayan soul at heart. Give me a warm cup of ${coffee}, a playlist with ${p2}, and someone genuine to share the view with. Simple joys.`
        ];
    } else if (vibe === 'artsy') {
        bios = [
            `Curating a life filled with ${p1}, independent bookstore finds, and specialty ${coffee}. Based in ${city}. Looking for a fellow dreamer to explore local indie spaces with. 🎨`,
            `${name} • Visual storyteller & coffee lover. Inspired by ${p2}, late afternoon golden hours, and raw vulnerability. Let's share ideas over pour-overs.`,
            `I like things that have soul—film photography, ${p1}, and single-origin coffee. If you value creativity and heartfelt dialogue, let's connect.`
        ];
    } else if (vibe === 'serious') {
        bios = [
            `Hi, I'm ${name}, living in ${city}. Seeking a genuine partnership grounded in mutual respect, shared core values, and lasting companionship. Let's begin with a quiet coffee date and see where life leads. 💍`,
            `Family-oriented, grounded, and focused on building a meaningful future. Enjoys ${p1}, wholesome weekends, and thoughtful discussions over ${coffee}. Serious inquiries only.`,
            `Looking for a life partner who balances ambition with warmth. In a fast-swiping world, I believe the best rishtas start with simple, honest conversation over a warm cup of coffee.`
        ];
    } else { // chill
        bios = [
            `Low-drama, high-${coffee} energy. Based in ${city}. Into ${p1}, good food, and comfortable silences. Looking for someone genuine to explore local cafes with. 🌿`,
            `Hey, I'm ${name}. Easygoing by nature. If you appreciate ${p2}, sunny afternoon walks, and no games, we'll get along great.`,
            `Just a human in ${city} who loves ${coffee} and ${p1}. If you're kind, humble, and know a good coffee spot, hit like.`
        ];
    }

    document.getElementById('bioText1').textContent = bios[0];
    document.getElementById('bioText2').textContent = bios[1];
    document.getElementById('bioText3').textContent = bios[2];

    document.getElementById('resultsWrapper').classList.remove('hidden');
    document.getElementById('resultsWrapper').scrollIntoView({ behavior: 'smooth' });
}

function copyGeneratedBio(elemId, btn) {
    const text = document.getElementById(elemId).textContent;
    navigator.clipboard.writeText(text).then(() => {
        const span = btn.querySelector('span');
        const original = span.textContent;
        span.textContent = 'Copied! ✓';
        btn.classList.add('bg-emerald-700');
        setTimeout(() => {
            span.textContent = original;
            btn.classList.remove('bg-emerald-700');
        }, 2000);
    });
}
</script>
@endsection
