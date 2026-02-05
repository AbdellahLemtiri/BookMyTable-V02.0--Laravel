<x-app-layout>
    <div class="bg-[#050505] min-h-screen text-white font-sans">
        
        <section class="relative py-24 border-b border-white/5 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-[#FF5F00]/10 via-transparent to-transparent">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <span class="text-[#FF5F00] font-black uppercase tracking-[5px] text-[10px] mb-4 block">Safi's Premium Dining</span>
                <h1 class="text-6xl md:text-8xl font-black italic uppercase tracking-tighter mb-8">
                    Réservez <span class="text-[#FF5F00]">l'Excellence.</span>
                </h1>
                
                <form action="{{ route('home') }}" method="GET" class="max-w-3xl mx-auto relative group">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Trouvez un restaurant, une ville أو نوع المطبخ..." 
                           class="w-full bg-[#111] border border-white/10 rounded-2xl px-8 py-5 text-sm focus:border-[#FF5F00] focus:ring-0 transition-all shadow-2xl">
                    <button type="submit" class="absolute right-3 top-3 bg-[#FF5F00] text-black font-black uppercase text-[10px] tracking-widest px-8 py-3 rounded-xl hover:bg-white transition-all">
                        Chercher
                    </button>
                </form>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <aside class="w-full lg:w-64 space-y-10">
                    <div>
                        <h3 class="text-[10px] font-black uppercase tracking-[3px] text-gray-500 mb-6">Catégories</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Marocaine', 'Italienne', 'Mer', 'Fast-Food'] as $tag)
                                <a href="?search={{ $tag }}" class="px-4 py-2 border border-white/5 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-[#FF5F00] hover:text-black transition-all">
                                    {{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <main class="flex-1">
                    @if($restaurants->isEmpty())
                        <div class="text-center py-20 border border-dashed border-white/10 rounded-3xl">
                            <p class="text-gray-500 uppercase font-black tracking-widest text-xs">Aucun résultat pour "{{ request('search') }}"</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            @foreach($restaurants as $restaurant)
                                <div class="group relative bg-[#0A0A0A] border border-white/5 rounded-[2.5rem] overflow-hidden hover:border-[#FF5F00]/30 transition-all duration-500">
                                    
                                    <div class="relative h-80 overflow-hidden">
                                        <img src="{{ asset('storage/' . $restaurant->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                                        
                                        <button class="absolute top-6 right-6 w-12 h-12 bg-black/50 backdrop-blur-xl rounded-full flex items-center justify-center text-white hover:bg-[#FF5F00] hover:text-black transition-all border border-white/10">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        </button>

                                        <div class="absolute bottom-6 left-8">
                                            <span class="bg-[#FF5F00] text-black text-[8px] font-black uppercase tracking-widest px-4 py-1.5 rounded-lg shadow-2xl">
                                                {{ $restaurant->city }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-10">
                                        <div class="flex justify-between items-start mb-6">
                                            <div>
                                                <h3 class="text-2xl font-black uppercase italic tracking-tighter mb-1">{{ $restaurant->name }}</h3>
                                                <p class="text-[9px] font-bold text-gray-500 uppercase tracking-[3px]">{{ $restaurant->cuisine_type }}</p>
                                            </div>
                                        </div>
                                        
                                        <a href="{{ route('restaurants.show', $restaurant) }}" class="inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-[4px] text-white hover:text-[#FF5F00] transition-colors group/link">
                                            Explorer & Réserver
                                            <span class="w-8 h-[1px] bg-[#FF5F00] group-hover/link:w-12 transition-all"></span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-16">
                            {{ $restaurants->links() }}
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
</x-app-layout>