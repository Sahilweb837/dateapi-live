@extends('layouts.app')

@php 
  $initialTab = $initialTab ?? (request()->routeIs('register') || request()->query('tab') === 'register' ? 'register' : 'signin'); 
@endphp

@section('title', ($initialTab === 'register' ? 'Join CupDate Free — Modern Intentional Dating' : 'Welcome Back — Log In to CupDate'))
@section('meta_desc', 'Sign in or create your free verified profile on CupDate. Meet genuine singles for low-pressure 45-minute coffee dates across Himachal Pradesh and India.')

@section('extra_head')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<style>
  .auth-gradient-btn {
    background: linear-gradient(135deg, #ff6584 0%, #fd748e 50%, #b0284b 100%);
  }
  .auth-glow-bg {
    background: linear-gradient(135deg, rgba(255,101,132,0.35) 0%, rgba(253,116,142,0.25) 50%, rgba(255,178,188,0.35) 100%);
  }
</style>
@endsection

@section('content')
<div class="min-h-[calc(100vh-80px)] w-full flex items-center justify-center bg-[#fbf8ff] font-['Plus_Jakarta_Sans',sans-serif] text-[#1b1b21] py-10 px-4 sm:px-6 relative overflow-hidden">
    
    <!-- Ambient Floating Blurs & Background Icons -->
    <div class="absolute -top-24 -left-20 w-96 h-96 rounded-full bg-[#fd748e]/20 blur-3xl pointer-events-none -z-10 animate-pulse"></div>
    <div class="absolute -bottom-24 -right-20 w-[28rem] h-[28rem] rounded-full bg-[#ff6584]/20 blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-1/3 left-4 md:left-24 text-[#b0284b]/15 pointer-events-none select-none -z-10">
        <span class="material-symbols-outlined text-6xl animate-bounce" style="animation-duration: 4s;">favorite</span>
    </div>
    <div class="absolute bottom-1/4 right-6 md:right-28 text-[#a8334e]/20 pointer-events-none select-none -z-10">
        <span class="material-symbols-outlined text-6xl" style="font-variation-settings: 'FILL' 1;">local_cafe</span>
    </div>
    <div class="absolute top-16 right-16 text-[#b0284b]/20 pointer-events-none select-none -z-10 rotate-12">
        <span class="material-symbols-outlined text-4xl">auto_awesome</span>
    </div>

    <!-- Main Auth Card Wrapper -->
    <div class="w-full max-w-md relative z-10 my-4">
        <!-- Glow border aura -->
        <div class="absolute -inset-1.5 auth-glow-bg rounded-3xl blur-xl opacity-80"></div>
        
        <!-- Card Body -->
        <div class="relative bg-white/95 backdrop-blur-2xl rounded-3xl p-6 sm:p-8 shadow-2xl border border-[#dfbfc2]/40 flex flex-col items-center text-center">
            
            <!-- Logo with Soft Glow -->
            <div class="relative mb-2 flex items-center justify-center">
                <div class="absolute w-20 h-20 rounded-full bg-[#ffd9dd]/60 blur-md"></div>
                <img alt="CupDate Logo" class="relative w-16 h-16 object-contain drop-shadow-md transition-transform duration-300 hover:scale-105" src="{{ asset('assets/images/cupdate_logo.svg') }}"/>
            </div>

            <h1 class="font-extrabold text-2xl sm:text-3xl text-[#1b1b21] tracking-tight mt-1" id="authTitle">
                {{ $initialTab === 'register' ? 'Join CupDate Free' : 'Welcome to CupDate' }}
            </h1>
            <p class="text-xs sm:text-sm text-[#584143] mt-1 max-w-xs" id="authSubtitle">
                {{ $initialTab === 'register' ? 'Create your profile in 30 seconds with 100% verified singles.' : 'Find your perfect cup of tea with genuine, verified matches.' }}
            </p>

            <!-- Pill Tab Switcher -->
            <div class="w-full mt-5 p-1 bg-[#f5f2fb] rounded-full border border-[#dfbfc2]/40 flex items-center gap-1 text-xs font-bold">
                <button type="button" onclick="switchAuthMode('signin')" id="tabBtnSignIn"
                        class="flex-1 py-2.5 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer {{ $initialTab === 'signin' ? 'bg-white text-[#1b1b21] shadow-sm font-extrabold' : 'text-[#584143] hover:text-[#1b1b21]' }}">
                    <span class="material-symbols-outlined text-base text-[#b0284b]">login</span>
                    <span>Sign In</span>
                </button>
                <button type="button" onclick="switchAuthMode('register')" id="tabBtnRegister"
                        class="flex-1 py-2.5 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer {{ $initialTab === 'register' ? 'bg-white text-[#1b1b21] shadow-sm font-extrabold' : 'text-[#584143] hover:text-[#1b1b21]' }}">
                    <span class="material-symbols-outlined text-base text-[#ff6584]">person_add</span>
                    <span>Create Account</span>
                </button>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="w-full mt-4 p-3 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2 text-left">
                    <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="w-full mt-4 p-3 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex items-center gap-2 text-left">
                    <span class="material-symbols-outlined text-rose-600 text-base shrink-0">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- ============================================== -->
            <!-- 1. SIGN IN FORM -->
            <!-- ============================================== -->
            <form action="{{ route('login.submit') }}" method="POST" class="w-full flex flex-col gap-3 text-left mt-5 {{ $initialTab === 'signin' ? 'flex' : 'hidden' }}" id="signInForm">
                @csrf

                <!-- Email or Admin ID -->
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-[#1b1b21] ml-2 flex items-center gap-1" for="signin-email">
                        <span class="material-symbols-outlined text-sm text-[#b0284b]">mail</span>
                        <span>Email address or Admin ID</span>
                    </label>
                    <div class="relative flex items-center">
                        <input class="w-full h-12 px-4 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs sm:text-sm font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all" 
                               id="signin-email" name="email" value="{{ old('email') }}" required type="text" placeholder="you@domain.com or admin" autocomplete="username"/>
                    </div>
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-between ml-2">
                        <label class="text-xs font-bold text-[#1b1b21] flex items-center gap-1" for="signin-password">
                            <span class="material-symbols-outlined text-sm text-[#b0284b]">lock</span>
                            <span>Password</span>
                        </label>
                        <a class="text-xs font-bold text-[#b0284b] hover:text-[#a8334e] transition-colors" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    </div>
                    <div class="relative flex items-center">
                        <input class="w-full h-12 pl-4 pr-12 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs sm:text-sm font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all" 
                               id="signin-password" name="password" placeholder="••••••••••••" required type="password" autocomplete="current-password"/>
                        <button aria-label="Toggle password visibility" class="absolute right-3 p-1.5 text-[#584143] hover:text-[#b0284b] transition-colors focus:outline-none flex items-center justify-center cursor-pointer" 
                                onclick="toggleAuthPass('signin-password', this)" type="button">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-xs text-[#584143] font-medium">
                        <input checked class="w-4 h-4 rounded-full accent-[#b0284b] focus:ring-0 cursor-pointer" id="remember" name="remember" type="checkbox"/>
                        <span>Remember me on this device</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button class="w-full h-12 mt-2 auth-gradient-btn text-white font-bold text-xs sm:text-sm rounded-full shadow-lg shadow-[#ff6584]/30 flex items-center justify-center gap-2 transition-all duration-300 hover:brightness-105 hover:shadow-xl hover:shadow-[#b0284b]/30 active:scale-[0.98] cursor-pointer group" type="submit">
                    <span>Start Finding Matches</span>
                    <span class="material-symbols-outlined text-base transition-transform duration-200 group-hover:translate-x-1">favorite</span>
                </button>
            </form>

            <!-- ============================================== -->
            <!-- 2. REGISTER FORM -->
            <!-- ============================================== -->
            <form action="{{ route('register.submit') }}" method="POST" class="w-full flex flex-col gap-3 text-left {{ $initialTab === 'register' ? 'flex' : 'hidden' }}" id="registerForm">
                @csrf

                <!-- Full Name -->
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-[#1b1b21] ml-2 flex items-center gap-1" for="reg-name">
                        <span class="material-symbols-outlined text-sm text-[#b0284b]">person</span>
                        <span>Your Full Name</span>
                    </label>
                    <input class="w-full h-12 px-4 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs sm:text-sm font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all" 
                           id="reg-name" name="full_name" value="{{ old('full_name') }}" required placeholder="e.g. Tanya Sharma" type="text"/>
                </div>

                <!-- Email -->
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-[#1b1b21] ml-2 flex items-center gap-1" for="reg-email">
                        <span class="material-symbols-outlined text-sm text-[#b0284b]">mail</span>
                        <span>Email address</span>
                    </label>
                    <input class="w-full h-12 px-4 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs sm:text-sm font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all" 
                           id="reg-email" name="email" value="{{ old('email') }}" required placeholder="you@domain.com" type="email" autocomplete="email"/>
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-[#1b1b21] ml-2 flex items-center gap-1" for="reg-password">
                        <span class="material-symbols-outlined text-sm text-[#b0284b]">lock</span>
                        <span>Choose Password (min 6 chars)</span>
                    </label>
                    <div class="relative flex items-center">
                        <input class="w-full h-12 pl-4 pr-12 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs sm:text-sm font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all" 
                               id="reg-password" name="password" placeholder="••••••••••••" required minlength="6" type="password" autocomplete="new-password"/>
                        <button aria-label="Toggle password visibility" class="absolute right-3 p-1.5 text-[#584143] hover:text-[#b0284b] transition-colors focus:outline-none flex items-center justify-center cursor-pointer" 
                                onclick="toggleAuthPass('reg-password', this)" type="button">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- 2-Column: DOB & Gender -->
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-bold text-[#1b1b21] ml-2 flex items-center gap-1" for="reg-dob">
                            <span class="material-symbols-outlined text-sm text-[#b0284b]">calendar_month</span>
                            <span>Birth Date</span>
                        </label>
                        <input class="w-full h-12 px-3 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all cursor-pointer" 
                               id="reg-dob" name="dob" value="{{ old('dob', '2000-01-01') }}" required type="date"/>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-bold text-[#1b1b21] ml-2 flex items-center gap-1" for="reg-gender">
                            <span class="material-symbols-outlined text-sm text-[#b0284b]">wc</span>
                            <span>Gender</span>
                        </label>
                        <select class="w-full h-12 px-3 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all appearance-none cursor-pointer" 
                                id="reg-gender" name="gender" required>
                            <option value="female" selected>Female</option>
                            <option value="male">Male</option>
                            <option value="nonbinary">Non-Binary</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- City / District -->
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-[#1b1b21] ml-2 flex items-center gap-1" for="reg-city">
                        <span class="material-symbols-outlined text-sm text-[#b0284b]">location_on</span>
                        <span>Your City / District</span>
                    </label>
                    <select class="w-full h-12 px-4 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition-all appearance-none cursor-pointer" 
                            id="reg-city" name="city">
                        <optgroup label="🏔️ Himachal Pradesh">
                            <option value="Shimla, Himachal Pradesh" selected>Shimla</option>
                            <option value="Manali, Himachal Pradesh">Manali &amp; Old Manali</option>
                            <option value="Dharamshala, Himachal Pradesh">Dharamshala &amp; McLeodGanj</option>
                            <option value="Kangra, Himachal Pradesh">Kangra Valley</option>
                            <option value="Solan, Himachal Pradesh">Solan</option>
                            <option value="Mandi, Himachal Pradesh">Mandi</option>
                            <option value="Kullu, Himachal Pradesh">Kullu</option>
                            <option value="Hamirpur, Himachal Pradesh">Hamirpur</option>
                        </optgroup>
                        <optgroup label="🏙️ North India &amp; Metros">
                            <option value="Chandigarh, Punjab">Chandigarh &amp; Mohali</option>
                            <option value="Delhi NCR, India">Delhi NCR</option>
                            <option value="Pune, Maharashtra">Pune</option>
                            <option value="Mumbai, Maharashtra">Mumbai</option>
                            <option value="Bangalore, Karnataka">Bangalore</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Submit Button -->
                <button class="w-full h-12 mt-2 auth-gradient-btn text-white font-bold text-xs sm:text-sm rounded-full shadow-lg shadow-[#ff6584]/30 flex items-center justify-center gap-2 transition-all duration-300 hover:brightness-105 hover:shadow-xl hover:shadow-[#b0284b]/30 active:scale-[0.98] cursor-pointer group" type="submit">
                    <span>Create Profile &amp; Pass Check</span>
                    <span class="material-symbols-outlined text-base transition-transform duration-200 group-hover:translate-x-1">auto_awesome</span>
                </button>
            </form>

            <!-- Bottom Toggle Links -->
            <div class="mt-4 pt-1 text-xs text-[#584143]" id="switchFooterText">
                <span id="switchPrompt">{{ $initialTab === 'register' ? 'Already have an account?' : 'New to CupDate?' }}</span>
                <button type="button" onclick="switchAuthMode('{{ $initialTab === 'register' ? 'signin' : 'register' }}')" id="switchActionBtn"
                        class="font-bold text-[#b0284b] hover:underline ml-1 cursor-pointer">
                    {{ $initialTab === 'register' ? 'Sign in to your account' : 'Create an account in 30s' }}
                </button>
            </div>

            <!-- Admin Notice / Quick Link -->
            <div class="mt-2 text-[11px] text-stone-400">
                Are you an administrator? 
                <a href="{{ route('admin.login') }}" class="text-[#b0284b] font-bold hover:underline">
                    Admin Command Portal →
                </a>
            </div>

            <!-- Trust Footer Inside Card -->
            <div class="w-full mt-5 pt-4 border-t border-[#dfbfc2]/30 flex items-center justify-center">
                <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1 text-[11px] text-stone-500 font-medium">
                    <span class="flex items-center gap-1 text-[#b0284b] font-bold">
                        <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">verified</span>
                        100% Verified Profiles
                    </span>
                    <span>•</span>
                    <span>Zero spam</span>
                    <span>•</span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">lock</span>
                        Cupid-safe encrypted chat
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function switchAuthMode(mode) {
    const signInForm = document.getElementById('signInForm');
    const registerForm = document.getElementById('registerForm');
    const tabBtnSignIn = document.getElementById('tabBtnSignIn');
    const tabBtnRegister = document.getElementById('tabBtnRegister');
    const authTitle = document.getElementById('authTitle');
    const authSubtitle = document.getElementById('authSubtitle');
    const switchPrompt = document.getElementById('switchPrompt');
    const switchActionBtn = document.getElementById('switchActionBtn');

    if (mode === 'register') {
        signInForm.classList.add('hidden');
        signInForm.classList.remove('flex');
        registerForm.classList.remove('hidden');
        registerForm.classList.add('flex');

        tabBtnRegister.className = "flex-1 py-2.5 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer bg-white text-[#1b1b21] shadow-sm font-extrabold";
        tabBtnSignIn.className = "flex-1 py-2.5 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer text-[#584143] hover:text-[#1b1b21]";

        authTitle.innerText = "Join CupDate Free";
        authSubtitle.innerText = "Create your profile in 30 seconds with 100% verified singles.";
        switchPrompt.innerText = "Already have an account?";
        switchActionBtn.innerText = "Sign in to your account";
        switchActionBtn.setAttribute('onclick', "switchAuthMode('signin')");
    } else {
        registerForm.classList.add('hidden');
        registerForm.classList.remove('flex');
        signInForm.classList.remove('hidden');
        signInForm.classList.add('flex');

        tabBtnSignIn.className = "flex-1 py-2.5 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer bg-white text-[#1b1b21] shadow-sm font-extrabold";
        tabBtnRegister.className = "flex-1 py-2.5 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer text-[#584143] hover:text-[#1b1b21]";

        authTitle.innerText = "Welcome to CupDate";
        authSubtitle.innerText = "Find your perfect cup of tea with genuine, verified matches.";
        switchPrompt.innerText = "New to CupDate?";
        switchActionBtn.innerText = "Create an account in 30s";
        switchActionBtn.setAttribute('onclick', "switchAuthMode('register')");
    }
}

function toggleAuthPass(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('.material-symbols-outlined');
    if (!input) return;
    if (input.type === 'password') {
        input.type = 'text';
        if (icon) icon.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        if (icon) icon.textContent = 'visibility';
    }
}
</script>
@endsection
