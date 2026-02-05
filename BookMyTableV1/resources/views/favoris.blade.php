<x-app-layout>
    <div class="relative bg-black py-20 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h1 class="text-5xl md:text-6xl font-black italic uppercase tracking-tighter text-white">
                        Ma <span class="text-[#FF5F00]">Sélection.</span>
                    </h1>
                    <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[4px] mt-2">
                        Vos restaurants préférés en un seul endroit
                    </p>
                </div>

                <div class="flex items-center gap-4 bg-[#111] px-6 py-3 rounded-full border border-white/5">
                    <span class="text-[#FF5F00] font-black text-2xl">{{ $restaurants->count() }}</span>
                    <span
                        class="text-gray-500 text-[8px] font-black uppercase tracking-widest">Établissements<br>Enregistrés</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20">
        @if ($restaurants->isEmpty())
            <div
                class="flex flex-col items-center justify-center py-32 border border-dashed border-white/10 rounded-[3rem] bg-[#050505]">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-8">
                    <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 uppercase font-black tracking-[4px] text-xs">Votre liste est vide</p>
                <a href="{{ route('home') }}"
                    class="mt-6 px-10 py-4 bg-[#FF5F00] text-black text-[10px] font-black uppercase tracking-widest rounded-full hover:scale-105 transition-transform">
                    Explorer les restaurants
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($restaurants as $restaurant)
                    <div
                        class="group relative bg-[#0A0A0A] border border-white/5 rounded-[2.5rem] overflow-hidden hover:border-[#FF5F00]/30 transition-all duration-500 shadow-2xl">

                        <!-- Image Section -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . $restaurant->photos[0]->url_photo) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]"
                                alt="{{ $restaurant->nom_restaurant }}">

                            <!-- Overlay Gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90">
                            </div>

                            <!-- Delete from Favoris (Toggle) -->
                            <form action="{{ route('home.like') }}" method="POST">
                                @csrf
                                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                                <button type="submit"
                                    class="absolute top-6 right-6 w-12 h-12 bg-[#FF5F00] text-black rounded-full flex items-center justify-center shadow-2xl hover:bg-white transition-all">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.5 3c1.372 0 2.615.551 3.512 1.435.897-.884 2.14-1.435 3.512-1.435 2.786 0 5.25 2.322 5.25 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Content Section -->
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="text-[9px] font-bold text-[#FF5F00] uppercase tracking-[4px] mb-2">
                                        {{ $restaurant->typeCuisine->nom_type_cuisine }}
                                    </p>
                                    <h3 class="text-xl font-black uppercase italic tracking-tighter text-white">
                                        {{ $restaurant->nom_restaurant }}
                                    </h3>
                                </div>
                            </div>

                            <p class="text-gray-500 text-[10px] uppercase tracking-widest mb-8 flex items-center gap-2">
                                <svg class="w-3 h-3 text-[#FF5F00]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $restaurant->adresse_restaurant }}
                            </p>

                            <div class="pt-6 border-t border-white/5 flex items-center justify-between">
                                <a href="{{ route('client.restaurant.show', $restaurant) }}"
                                    class="text-[9px] font-black uppercase tracking-[3px] text-white hover:text-[#FF5F00] transition-colors">
                                    Réserver maintenant
                                </a>
                                <div class="flex gap-1">
                                    <div class="w-1 h-1 rounded-full bg-[#FF5F00]"></div>
                                    <div class="w-1 h-1 rounded-full bg-[#FF5F00]/50"></div>
                                    <div class="w-1 h-1 rounded-full bg-[#FF5F00]/20"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
