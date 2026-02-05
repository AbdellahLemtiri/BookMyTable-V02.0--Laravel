<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        
        .min-h-screen { background-color: #000 !important; }
        
        .image-side {
            background-image: url('https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1470&auto=format&fit=crop');
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
            <div class="absolute inset-0 bg-black/50"></div> 
            <div class="absolute top-10 left-10 text-white text-2xl font-black tracking-tighter">
                YOUCO<span class="text-[#FF5F00]">DONE</span>
            </div>
        </div>

        <div class="w-full lg:w-[45%] bg-[#0A0A0A] flex items-center justify-center p-6">
            
            <div class="w-full max-w-[320px]"> 
                
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-white text-3xl font-black mb-3 tracking-tight italic">Reset.</h2>
                    <p class="text-gray-500 text-xs leading-relaxed uppercase tracking-wider">
                        {{ __('Oublié votre mot de passe ? Pas de souci. Entrez votre email pour recevoir un lien de réinitialisation.') }}
                    </p>
                </div>

                <x-auth-session-status class="mb-6 text-[#FF5F00] text-xs font-bold bg-[#FF5F00]/10 p-3 rounded-lg border border-[#FF5F00]/20" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                            placeholder="Votre adresse email" required autofocus
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-4 text-sm text-white outline-none orange-glow transition-all" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] text-red-500 font-bold uppercase tracking-tighter" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full bg-[#FF5F00] hover:bg-[#E65600] text-white text-[10px] font-black py-4 rounded-lg shadow-lg shadow-[#FF5F00]/10 uppercase tracking-[2px] transition-all transform active:scale-95">
                            {{ __('Envoyer le lien') }}
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center lg:text-left">
                    <a href="{{ route('login') }}" class="text-[10px] text-gray-500 hover:text-white uppercase font-black tracking-[2px] transition-all">
                        ← {{ __('Retour à la connexion') }}
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</x-guest-layout>