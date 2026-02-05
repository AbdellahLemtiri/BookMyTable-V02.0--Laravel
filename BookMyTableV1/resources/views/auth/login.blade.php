<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        
        /* Layout fix bach n-ghlbou 3la default guest layout */
        .min-h-screen { background-color: #000 !important; }
        
        .image-side {
            background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=1470&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .orange-glow:focus {
            border-color: #FF5F00 !important;
            box-shadow: 0 0 10px rgba(255, 95, 0, 0.2) !important;
        }
    </style>

    <div class="fixed inset-0 flex items-stretch overflow-hidden font-['Inter']">
        
        <div class="hidden lg:block lg:w-[55%] image-side relative">
            <div class="absolute inset-0 bg-black/40"></div> 
            <div class="absolute top-10 left-10 text-white">
                <h1 class="text-2xl font-black tracking-tighter">YOUCO<span class="text-[#FF5F00]">DONE</span></h1>
            </div>
        </div>

        <div class="w-full lg:w-[45%] bg-[#0A0A0A] flex items-center justify-center p-6 relative">
            
            <div class="w-full max-w-[320px]"> 
                
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-white text-3xl font-black mb-2 tracking-tight">Login.</h2>
                    <p class="text-gray-500 text-sm">Entrez vos accès pour continuer.</p>
                </div>

                <x-auth-session-status class="mb-4 text-[#FF5F00] text-xs font-bold" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                            placeholder="Email" required autofocus
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-3 text-sm text-white outline-none orange-glow transition-all" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] text-red-500 font-bold uppercase tracking-tighter" />
                    </div>

                    <div class="space-y-1">
                        <input id="password" type="password" name="password" 
                            placeholder="Mot de passe" required autocomplete="current-password"
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-3 text-sm text-white outline-none orange-glow transition-all" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] text-red-500 font-bold uppercase tracking-tighter" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded border-white/10 bg-[#151515] text-[#FF5F00] shadow-sm focus:ring-[#FF5F00]" name="remember">
                            <span class="ms-2 text-[10px] text-gray-500 uppercase font-bold tracking-widest">{{ __('Remember') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-[10px] text-gray-600 hover:text-[#FF5F00] uppercase font-bold tracking-widest transition" href="{{ route('password.request') }}">
                                {{ __('Oublié ?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" 
                        class="w-full bg-[#FF5F00] hover:bg-[#E65600] text-white text-xs font-black py-4 rounded-lg shadow-lg shadow-[#FF5F00]/10 uppercase tracking-[2px] transition-all transform active:scale-95">
                        {{ __('Se Connecter') }}
                    </button>
                </form>

                <div class="mt-12 text-center lg:text-left">
                    <p class="text-[12px] text-gray-500">
                        Nouveau ici ? 
                        <a href="{{ route('register') }}" class="text-white font-bold border-b border-[#FF5F00] pb-1 ml-1 hover:text-[#FF5F00] transition">
                            Créer un compte
                        </a>
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</x-guest-layout>