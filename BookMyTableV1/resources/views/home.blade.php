<x-app-layout>
    <!-- Hero Section - Plus sobre -->
    <div class="bg-black py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-8">
                Trouvez votre
                <span class="text-[#FF5F00]">table</span>
            </h1>
            
            <form action="{{ route('home') }}" method="POST" class="max-w-md mx-auto">
                @csrf
                @method('POST')
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           placeholder="Ville, cuisine, restaurant..."
                           value="{{ request('search') }}"
                           class="w-full bg-gray-900 border border-gray-800 rounded-full text-white px-6 py-4 text-sm outline-none focus:border-[#FF5F00] transition-all">
                    <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-500 hover:text-[#FF5F00] transition-colors" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Restaurants Grid -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        @if ($restaurants->isEmpty())
            <div class="text-center py-20">
                <p class="text-gray-500 text-lg mb-4">Aucun restaurant trouvé</p>
                <a href="{{ route('home') }}" 
                   class="text-[#FF5F00] hover:underline">
                    Voir tous les restaurants
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($restaurants as $restaurant)
                    <div class="group bg-gray-900 rounded-2xl overflow-hidden hover:shadow-xl transition-all">
                        
                        <!-- Image -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . $restaurant->photos[0]->url_photo) }}" 
                                 alt="{{ $restaurant->nom_restaurant }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            <!-- Like button -->
                            <form action="{{ route('home.like') }}" method="POST" class="absolute top-4 right-4">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                                <button type="submit" 
                                        class="w-10 h-10 bg-black/50 rounded-full flex items-center justify-center 
                                               hover:bg-[#FF5F00] transition-colors">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                            
                            <!-- Location badge -->
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-[#FF5F00] text-black text-xs font-semibold px-3 py-1 rounded-lg">
                                    {{ $restaurant->ville->nom_ville ?? $restaurant->adresse_restaurant }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="mb-4">
                                <p class="text-[#FF5F00] text-sm font-semibold mb-1">
                                    {{ $restaurant->typeCuisine->nom_type_cuisine }}
                                </p>
                                <h3 class="text-xl font-bold text-white mb-2">
                                    {{ $restaurant->nom_restaurant }}
                                </h3>
                                <p class="text-gray-400 text-sm">
                                    {{ Str::limit($restaurant->description_restaurant, 100) }}
                                </p>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-800">
                                <a href="{{ route('client.restaurant.show', $restaurant) }}" 
                                   class="text-white hover:text-[#FF5F00] font-semibold text-sm transition-colors">
                                    Voir détails →
                                </a>
                                <span class="text-gray-500 text-sm">
                                    {{ $restaurant->heure_ouverture }} - {{ $restaurant->heure_fermeture }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>