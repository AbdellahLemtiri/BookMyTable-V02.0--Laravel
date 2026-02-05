<x-guest-layout>
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 mb-3">
            <i class="fas fa-sign-in-alt text-xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Se connecter</h2>
        <p class="text-gray-500 text-sm">Heureux de vous revoir !</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Adresse Email')" class="text-gray-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm py-2.5" 
                          type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nom@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-700 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm py-2.5" 
                          type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-emerald-600 hover:text-emerald-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-emerald-200 transition transform hover:-translate-y-0.5">
                {{ __('Se connecter') }}
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="font-medium text-emerald-600 hover:text-emerald-500 hover:underline">
                    S'inscrire
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>