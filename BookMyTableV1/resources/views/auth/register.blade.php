<x-guest-layout>
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 mb-3">
            <i class="fas fa-user-plus text-xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Créer un compte</h2>
        <p class="text-gray-500 text-sm">Rejoignez la communauté BookMyTable</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom complet')" class="text-gray-700 font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm py-2.5" 
                          type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ex: Abdellah Lemtiri" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Je veux m\'inscrire comme :')" class="text-gray-700 font-semibold" />
            <div class="relative mt-1">
                <select id="role" name="role" 
                        class="block w-full border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 shadow-sm appearance-none transition cursor-pointer" required>
                    <option value="" disabled selected>-- Choisissez votre rôle --</option>
                    <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>👤 Client (Je veux réserver)</option>
                    <option value="restaurateur" {{ old('role') == 'restaurateur' ? 'selected' : '' }}>🍽️ Restaurateur (J'ai un restaurant)</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Adresse Email')" class="text-gray-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm py-2.5" 
                          type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nom@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-700 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm py-2.5" 
                          type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-gray-700 font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm py-2.5" 
                          type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6 pt-2">
            <a class="text-sm text-gray-600 hover:text-emerald-600 transition underline decoration-emerald-200 hover:decoration-emerald-600" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>

            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-emerald-200 transition transform hover:-translate-y-0.5">
                {{ __('S\'inscrire') }}
            </button>
        </div>
    </form>
</x-guest-layout>