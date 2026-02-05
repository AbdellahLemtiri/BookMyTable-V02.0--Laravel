<x-app-layout>
    <div class="relative bg-black py-24 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-7xl font-black italic uppercase tracking-tighter text-white mb-10">
                trouver votre <span class="text-[#FF5F00]">table.</span>
            </h1>

            <form action="{{ route('home') }}" method="POST" class="max-w-xl mx-auto">
                @csrf
                @method('POST')
                <div class="relative group">
                    <input type="text" name="search" placeholder="Rechercher par ville, cuisine..."
                        class="w-full bg-[#111] border border-white/10 rounded-full text-white px-10 py-5 text-xs outline-none focus:border-[#FF5F00] focus:ring-1 focus:ring-[#FF5F00] transition-all uppercase tracking-[2px]"
                        value="{{ request('search') }}">
                    <button type="submit" class="absolute right-6 top-5">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-[#FF5F00] transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20">
        @if ($restaurants->isEmpty())
            <div
                class="flex flex-col items-center justify-center py-32 border border-dashed border-white/10 rounded-[3rem]">
                <p class="text-gray-500 uppercase font-black tracking-[4px] text-xs">Aucun résultat trouvé</p>
                <a href="{{ route('home') }}"
                    class="mt-6 text-[#FF5F00] text-[10px] font-black uppercase tracking-widest hover:underline">Voir
                    tous les restaurants</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($restaurants as $restaurant)
                    <div
                        class="group relative bg-[#0A0A0A] border border-white/5 rounded-[2.5rem] overflow-hidden hover:border-[#FF5F00]/30 transition-all duration-500 shadow-2xl">

                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ asset('storage/' . $restaurant->photos[0]->url_photo) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]"
                                alt="{{ $restaurant->nom_restaurant }}">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                            </div>

                            <form action=" {{ route('home.like') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                                <button
                                    class="absolute top-6 right-6 w-12 h-12 bg-black/40 backdrop-blur-xl rounded-full flex items-center justify-center text-white hover:bg-[#FF5F00] hover:text-black transition-all border border-white/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>

                            <div class="absolute bottom-6 left-8">
                                <span
                                    class="bg-[#FF5F00] text-black text-[9px] font-black uppercase tracking-widest px-4 py-1.5 rounded-lg shadow-2xl">
                                    {{ $restaurant->adresse_restaurant }}
                                </span>
                            </div>
                        </div>

                        <div class="p-10">
                            <div class="mb-6">
                                <p class="text-[9px] font-bold text-[#FF5F00] uppercase tracking-[4px] mb-2">
                                    {{ $restaurant->typeCuisine->nom_type_cuisine }}</p>
                                <h3 class="text-2xl font-black uppercase italic tracking-tighter text-white">
                                    {{ $restaurant->nom_restaurant }}</h3>
                            </div>

                            <div class="flex items-center justify-between">
                                <a href="{{ route('client.restaurant.show', $restaurant) }}"
                                    class="inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-[4px] text-white hover:text-[#FF5F00] transition-colors group/link">
                                    Explorer
                                    <span class="w-8 h-[1px] bg-[#FF5F00] group-hover/link:w-12 transition-all"></span>
                                </a>
                                <span class="text-gray-700 text-[8px] font-black uppercase tracking-widest">Available
                                    Now</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
