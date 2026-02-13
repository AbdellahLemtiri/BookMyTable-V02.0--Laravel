<nav x-data="{ open: false, userMenu: false }" class="bg-black border-b border-white/5 relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="flex items-center">
                <a href="/" class="group">
                    <span
                        class="text-white text-xl font-black tracking-tighter italic uppercase group-hover:text-[#FF5F00] transition-colors">
                        YOUCO<span class="text-[#FF5F00] group-hover:text-white transition-colors">DONE.</span>
                    </span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-12">



                @role('client')
                    <a href="{{ route('home') }}"
                        class="text-[10px] font-black uppercase tracking-[3px] text-orange-500 hover:text-white transition-all">Exploration</a>
                    <a href="{{ route('client.favoris') }}"
                        class="text-[10px] font-black uppercase tracking-[3px] text-orange-500 hover:text-white transition-all">Mes
                        Favoris</a>
                    <a href="{{route('reservations.history')}}"
                        class="text-[10px] font-black uppercase tracking-[3px] text-orange-500 hover:text-white transition-all">Mes
                        Réservations</a>
                @endrole

                @role('restaurateur')
                    <a href="{{ route('restaurateur.dashboard') }}"
                        class="text-[10px] font-black uppercase tracking-[3px] text-orange-500 hover:text-white transition-all">Mes
                        Restaurants</a>
                @endrole

                @role('admin')
                    <a href="{{ route('admin.gestion') }}"
                        class="text-[10px] font-black uppercase tracking-[3px] text-[#FF5F00] hover:text-white transition-all">Gestion
                        Users</a>
                    <a href="{{ route('admin.restaurants') }}"
                        class="text-[10px] font-black uppercase tracking-[3px] text-[#FF5F00] hover:text-white-500 hover:text-white transition-all">Gestion
                        Restaurants</a>
                @endrole
            </div>

            <div class="hidden md:flex items-center gap-6">
                <div class="relative">
                    <button @click="userMenu = !userMenu" @click.away="userMenu = false"
                        class="flex items-center gap-3 group outline-none">
                        <div class="text-right">
                            <p
                                class="text-[10px] font-black uppercase tracking-widest text-white group-hover:text-[#FF5F00] transition-colors">
                                {{ Auth::user()->username }}</p>
                            <p class="text-[7px] font-bold uppercase tracking-[2px] text-[#FF5F00] opacity-80">
                                {{ Auth::user()->roles->first()->name ?? 'User' }}</p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full border border-white/10 p-1 group-hover:border-[#FF5F00] transition-all overflow-hidden">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . Auth::user()->username . '&background=FF5F00&color=fff' }}"
                                class="w-full h-full rounded-full object-cover grayscale hover:grayscale-0 transition-all"
                                alt="Avatar">
                        </div>
                    </button>

                    <div x-show="userMenu" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute right-0 mt-4 w-56 bg-[#0E0E0E] border border-white/5 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] py-3 z-50">

                        <div class="px-6 py-2 mb-2">
                            <p class="text-[8px] font-bold text-gray-600 uppercase tracking-[2px]">Options</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#FF5F00] hover:bg-white/5 transition-all">
                            Profil Settings
                        </a>

                        @role('restaurateur')
                            <a href="{{ route('restaurants.create') }}"
                                class="flex items-center gap-3 px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#FF5F00] hover:bg-white/5 transition-all">
                                Ajouter Restaurant
                            </a>
                        @endrole

                        <div class="h-[1px] bg-white/5 my-2 mx-4"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-6 py-3 text-[10px] font-black uppercase tracking-widest text-red-500 hover:bg-red-500/10 transition-all">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-white hover:text-[#FF5F00] transition-colors">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition class="md:hidden bg-black border-t border-white/5 px-6 py-10 space-y-8">
        @role('client')
            <a href="#" class="block text-2xl font-black italic uppercase tracking-tighter text-white">Exploration</a>
            <a href="#" class="block text-2xl font-black italic uppercase tracking-tighter text-white">Favoris</a>
        @endrole

        @role('restaurateur')
            <a href="#" class="block text-2xl font-black italic uppercase tracking-tighter text-white">Mes
                Restaurants</a>
        @endrole

        <div class="h-[1px] bg-white/5 w-full"></div>
        <a href="{{ route('profile.edit') }}"
            class="block text-sm font-bold uppercase tracking-widest text-[#FF5F00]">Mon Profil</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block text-sm font-bold uppercase tracking-widest text-red-600">Log
                Out</button>
        </form>
    </div>
</nav>
