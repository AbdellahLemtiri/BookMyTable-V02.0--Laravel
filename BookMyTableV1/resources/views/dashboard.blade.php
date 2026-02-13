<x-app-layout>
    <div class="bg-black min-h-screen pb-20">
        <div class="border-b border-white/10 py-10 bg-[#050505]">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-end">
                <div>
                    <p class="text-[#FF5F00] font-bold uppercase tracking-[3px] text-[10px] mb-2">Restaurateur Area</p>
                    <h1 class="text-4xl font-black uppercase text-white">Dashboard.</h1>
                </div>
                <a href="{{ route('restaurants.create') }}"
                    class="bg-[#FF5F00] text-black font-black uppercase text-[11px] tracking-tighter px-6 py-4 rounded-none hover:bg-white transition-all">
                    + Ajouter Restaurant
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0">
                @foreach ($restaurants as $restaurant)
                    <div
                        class="bg-[#0A0A0A] border border-white/10 aspect-square flex flex-col group relative overflow-hidden">

                        <div class="h-1/2 w-full bg-[#111] overflow-hidden">
                            <img src="{{ asset('storage/' . $restaurant->photos[0]->url_photo) }}"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                        </div>

                        <div class="h-1/2 p-8 flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-black text-white uppercase italic leading-none mb-2">
                                    {{ $restaurant->nom_restaurant }}</h3>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">
                                    {{ $restaurant->adresse_restaurant }} — {{ $restaurant->typeCuisine->nom_type_cuisine }}</p>
                            </div>

                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between items-end">
                                    <span class="text-[9px] font-black text-[#FF5F00] uppercase">0 Réservations</span>

                                    <div class="flex gap-2">
                                        <a href="{{ route('restaurants.edit', $restaurant) }}"
                                            class="text-white hover:text-[#FF5F00] transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        @role('restaurateur')
                                            <button onclick="openDeleteModal({{ $restaurant->id }} , '{{ $restaurant->nom_restaurant }}')"
                                                class="text-gray-600 hover:text-red-500 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>

                                            <form id="delete-form-{{ $restaurant->id }}"
                                                action="{{ route('restaurants.destroy', $restaurant) }}"
                                                method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endrole
                                    </div>
                                </div>

                                <a href="{{ route('restaurants.show', $restaurant) }}"
                                    class="w-full border border-white/10 py-3 text-center text-[10px] font-black uppercase text-white hover:bg-[#FF5F00] hover:border-[#FF5F00] hover:text-black transition-all">
                                    Voir Restaurant
                                </a>
                            </div>
                        </div>

                        <div
                            class="absolute inset-0 border-2 border-[#FF5F00] opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div id="deleteModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-[#0A0A0A] border-2 border-red-500/30 rounded-2xl p-8 max-w-md w-full mx-4 relative overflow-hidden">
            
            <!-- Red accent line -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-orange-500"></div>
            
            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 rounded-full bg-red-500/10 flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <!-- Content -->
            <div class="text-center mb-8">
                <h3 class="text-2xl font-black text-white uppercase italic mb-3">
                    Supprimer Restaurant<span class="text-red-500">?</span>
                </h3>
                <p class="text-sm text-gray-400 mb-2">Vous êtes sur le point de supprimer</p>
                <p class="text-lg font-bold text-[#FF5F00] uppercase tracking-wide" id="restaurantName"></p>
                <p class="text-xs text-gray-500 mt-4">Cette action est irréversible.</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()"
                    class="flex-1 bg-white/5 border border-white/10 text-white font-black uppercase text-[10px] tracking-widest py-4 rounded-lg hover:bg-white/10 transition-all">
                    Annuler
                </button>
                <button onclick="confirmDelete()"
                    class="flex-1 bg-red-500 text-white font-black uppercase text-[10px] tracking-widest py-4 rounded-lg hover:bg-red-600 transition-all">
                    Supprimer
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentRestaurantId = null;

        function openDeleteModal(restaurantId, restaurantName) {
            currentRestaurantId = restaurantId;
            document.getElementById('restaurantName').textContent = restaurantName;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
            currentRestaurantId = null;
        }

        function confirmDelete() {
            if (currentRestaurantId) {
                document.getElementById('delete-form-' + currentRestaurantId).submit();
            }
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Close modal on backdrop click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>