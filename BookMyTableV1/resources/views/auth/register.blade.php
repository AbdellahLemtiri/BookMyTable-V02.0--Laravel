<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

        .min-h-screen {
            background-color: #000 !important;
        }

        .image-side {
            background-image: url('https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1474&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .orange-glow:focus {
            border-color: #FF5F00 !important;
            box-shadow: 0 0 10px rgba(255, 95, 0, 0.2) !important;
        }

        /* Style khass l-select bach yban m9awad f ga3 l-navigateurs */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23FF5F00'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }
    </style>

    <div class="fixed inset-0 flex items-stretch overflow-hidden font-['Inter']">

        <div class="hidden lg:block lg:w-[55%] image-side relative">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute top-10 left-10 text-white">
                <h1 class="text-2xl font-black tracking-tighter">YOUCO<span class="text-[#FF5F00]">DONE</span></h1>
            </div>
        </div>

        <div class="w-full lg:w-[45%] bg-[#0A0A0A] flex items-center justify-center p-6 relative overflow-y-auto">

            <div class="w-full max-w-[320px] py-8">

                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-white text-3xl font-black mb-2 tracking-tight">Inscription.</h2>
                    <p class="text-gray-500 text-sm">Choisissez votre rôle et commencez.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf


                    <div class="space-y-1">
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Nom complet" required autofocus
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-3 text-sm text-white outline-none orange-glow transition-all" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-[10px] text-red-500 font-bold uppercase" />
                    </div>

                    <div class="space-y-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="Email" required
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-3 text-sm text-white outline-none orange-glow transition-all" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] text-red-500 font-bold uppercase" />
                    </div>

                    <div class="space-y-1">
                        <select id="role" name="role" required
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-3 text-sm text-white outline-none orange-glow transition-all cursor-pointer">
                            <option value="" disabled selected>Je suis un...</option>
                            <option value="client" class="bg-[#151515]">Client </option>
                            <option value="restaurateur" class="bg-[#151515]">Restaurateur </option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1 text-[10px] text-red-500 font-bold uppercase" />
                    </div>

                    <div class="space-y-1">
                        <input id="password" type="password" name="password" placeholder="Mot de passe" required
                            autocomplete="new-password"
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-3 text-sm text-white outline-none orange-glow transition-all" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] text-red-500 font-bold uppercase" />
                    </div>

                    <div class="space-y-1">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Confirmer mot de passe" required
                            class="w-full bg-[#151515] border border-white/5 rounded-lg px-4 py-3 text-sm text-white outline-none orange-glow transition-all" />
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-[#FF5F00] hover:bg-[#E65600] text-white text-xs font-black py-4 rounded-lg shadow-lg shadow-[#FF5F00]/10 uppercase tracking-[2px] transition-all transform active:scale-95">
                            {{ __('Créer mon compte') }}
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center lg:text-left border-t border-white/5 pt-6">
                    <p class="text-[12px] text-gray-500 font-medium">
                        Déjà inscrit ?
                        <a href="{{ route('login') }}"
                            class="text-white font-bold border-b border-[#FF5F00] pb-1 ml-1 hover:text-[#FF5F00] transition-all">
                            Se connecter
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
