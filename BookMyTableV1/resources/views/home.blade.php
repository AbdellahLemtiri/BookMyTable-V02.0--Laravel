<x-app-layout>
    <div class="relative bg-black py-24 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-orange-900/20 via-transparent to-transparent"></div>
        
        <div class="relative max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
                Réservez votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF5F00] to-orange-400">expérience</span>
            </h1>
            <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">Découvrez les meilleures tables de la ville et réservez en un clic.</p>
            
            <form action="{{ route('home') }}" method="POST" class="max-w-2xl mx-auto">
                @csrf
                <div class="group relative flex items-center">
                    <input type="text" 
                           name="search" 
                           placeholder="Une ville, une cuisine, une envie..."
                           value="{{ request('search') }}"
                           class="w-full bg-gray-900/50 backdrop-blur-xl border border-gray-800 rounded-2xl text-white px-8 py-5 text-lg outline-none focus:ring-2 focus:ring-[#FF5F00]/50 focus:border-[#FF5F00] transition-all duration-300">
                    
                    <button type="submit" class="absolute right-3 bg-[#FF5F00] hover:bg-[#ff7b29] text-black p-3 rounded-xl transition-all duration-300 group-hover:scale-105">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-3xl font-bold text-white">Restaurants à la une</h2>
                <div class="h-1 w-20 bg-[#FF5F00] mt-2 rounded-full"></div>
            </div>
        </div>

        @if ($restaurants->isEmpty())
            <div class="text-center py-24 bg-gray-900/30 rounded-3xl border border-dashed border-gray-800">
                <div class="mb-6 inline-block p-4 bg-gray-800/50 rounded-full">
                    <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-gray-400 text-xl font-medium mb-4">Aucun restaurant ne correspond à votre recherche</p>
                <a href="{{ route('home') }}" class="inline-flex items-center text-[#FF5F00] font-semibold hover:gap-2 transition-all">
                    <span>Réinitialiser les filtres</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2" stroke-linecap="round"/></svg>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($restaurants as $restaurant)
                    <div class="group relative bg-gray-900/40 border border-gray-800 rounded-3xl overflow-hidden hover:border-[#FF5F00]/30 transition-all duration-500 hover:-translate-y-2">
                        
                        <div class="relative h-64 overflow-hidden">
                            @if($restaurant->photos->isNotEmpty())
                                <img src="{{ asset('storage/' . $restaurant->photos->first()->url_photo) }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                    <span class="text-gray-600">Aucune image</span>
                                </div>
                            @endif
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-80"></div>

                            <div class="absolute top-4 left-4 flex gap-2">
                                <span class="backdrop-blur-md bg-black/40 text-[#FF5F00] text-xs font-bold px-3 py-1.5 rounded-lg uppercase tracking-wider border border-white/10">
                                    {{ $restaurant->typeCuisine->nom_type_cuisine }}
                                </span>
                            </div>

                            <form action="{{ route('home.like') }}" method="POST" class="absolute top-4 right-4">
                                @csrf
                                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                                <button type="submit" class="p-3 bg-white/10 backdrop-blur-md rounded-2xl hover:bg-[#FF5F00] hover:text-black text-white transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="p-8">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-2xl font-bold text-white group-hover:text-[#FF5F00] transition-colors">
                                    {{ $restaurant->nom_restaurant }}
                                </h3>
                                <div class="flex items-center text-gray-500 text-xs">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    {{ $restaurant->heure_ouverture }}
                                </div>
                            </div>

                            <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-2">
                                {{ $restaurant->description_restaurant }}
                            </p>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-800">
                                <div class="flex items-center text-gray-400">
                                    <svg class="w-4 h-4 mr-2 text-[#FF5F00]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                    <span class="text-xs font-medium">{{ $restaurant->ville->nom_ville ?? 'Ville non précisée' }}</span>
                                </div>
                                
                                <a href="{{ route('client.restaurant.show', $restaurant) }}" 
                                   class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-800 hover:bg-[#FF5F00] text-white hover:text-black font-bold text-xs rounded-xl transition-all duration-300">
                                    Détaile
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>