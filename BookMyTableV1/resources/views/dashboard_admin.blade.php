<x-app-layout>
    <div class="bg-black min-h-screen pb-20">

        <div class="border-b border-white/10 py-12 bg-[#050505]">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 bg-red-600"></span>
                        <p class="text-red-600 font-bold uppercase tracking-[4px] text-[10px]">Administrator Control
                            Panel</p>
                    </div>
                    <h1 class="text-4xl font-black italic uppercase text-white tracking-tighter">Youco'Done <span
                            class="text-white/20">System.</span></h1>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="bg-[#0A0A0A] border border-white/10 p-5 min-w-[140px]">
                        <p class="text-gray-500 text-[8px] font-black uppercase tracking-widest mb-1">Total Users</p>
                        <p class="text-xl font-black text-white leading-none italic">{{ $users_count }}</p>
                    </div>
                    <div class="bg-[#0A0A0A] border border-white/10 p-5 min-w-[140px]">
                        <p class="text-gray-500 text-[8px] font-black uppercase tracking-widest mb-1">Active Restaurants
                        </p>
                        <p class="text-xl font-black text-[#FF5F00] leading-none italic">{{ $restaurants->count() }}</p>
                    </div>
                     
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-12">

            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white text-[11px] font-black uppercase tracking-[5px]">Gestion des établissements actifs
                </h2>
                <div class="flex gap-2">
                    <span class="text-gray-600 text-[10px] uppercase font-bold italic">Admin Access Only</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0">
                @foreach ($restaurants as $restaurant)
                    <div class="bg-[#0A0A0A] border border-white/5 aspect-square flex flex-col group relative">

                        <div
                            class="h-1/2 w-full grayscale group-hover:grayscale-0 transition-all duration-700 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $restaurant->image) }}" class="w-full h-full object-cover">
                            <div
                                class="absolute top-4 left-4 bg-black/80 px-3 py-1 text-[8px] text-white font-black uppercase tracking-widest border border-white/10">
                                ID: #{{ $restaurant->id }}
                            </div>
                        </div>

                        <div class="h-1/2 p-8 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-black text-white uppercase italic tracking-tight">
                                        {{ $restaurant->name }}</h3>
                                    <span
                                        class="text-[8px] font-bold text-gray-500 uppercase">{{ $restaurant->typeCuisine->name ?? 'Cuisine' }}</span>
                                </div>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-4">
                                    Propriétaire: <span class="text-white">{{ $restaurant->nom_restaurat }}</span></p>
                            </div>

                            <div class="space-y-3">
                                <div
                                    class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest border-b border-white/5 pb-2">
                                    <span class="text-gray-500 italic">Ville: {{ $restaurant->city }}</span>
                                    <span class="text-[#FF5F00]">{{ $restaurant->reservations_count }} Bookings</span>
                                </div>

                                <div class="flex gap-2 pt-2">
                                    <form action="{{ route('admin.restaurant.destroy', $restaurant) }} " method="POST" class="flex-1"
                                        onsubmit="return confirm('ALERTE: Voulez-vous vraiment supprimer ce restaurant du système ?')">
                                        @csrf @method('DELETE')
                                        <button
                                            class="w-full bg-red-600/10 hover:bg-red-600 text-red-600 hover:text-white border border-red-600/20 py-3 text-[10px] font-black uppercase transition-all tracking-tighter">
                                            Supprimer Restaurant
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.restaurant.show', $restaurant) }}"
                                        class="flex-1 border border-white/10 hover:border-white py-3 text-center text-[10px] font-black uppercase text-white transition-all tracking-tighter">
                                        Voir Restaurant
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute inset-0 border border-red-600 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
                        </div>
                    </div>
                @endforeach
            </div>

            

        </div>
    </div>
</x-app-layout>
