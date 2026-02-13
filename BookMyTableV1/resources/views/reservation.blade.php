<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                
                <div class="p-6 bg-indigo-600 text-white">
                    <h2 class="text-2xl font-bold">
                        🍽️ Réserver chez : {{ $restaurant->nom_restaurant }}
                    </h2>
                    <p class="mt-2 text-indigo-100">
                        Remplissez le formulaire ci-dessous pour confirmer votre table.
                    </p>
                </div>

                <div class="p-6 text-gray-900">
                    
 
                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Attention</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
 
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label for="date_reservation" class="block text-sm font-medium text-gray-700">Date de réservation</label>
                                <input type="date" 
                                       name="date_reservation" 
                                       id="date_reservation" 
                                       min="{{ date('Y-m-d') }}"
                                       value="{{ old('date_reservation') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date_reservation') border-red-500 @enderror"
                                       required>
                                @error('date_reservation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="heure_reservation" class="block text-sm font-medium text-gray-700">Heure d'arrivée</label>
                                <input type="time" 
                                       name="heure_reservation" 
                                       id="heure_reservation" 
                                       value="{{ old('heure_reservation') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('heure_reservation') border-red-500 @enderror"
                                       required>
                                @error('heure_reservation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="nb_personnes" class="block text-sm font-medium text-gray-700">Nombre de personnes</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" 
                                       name="nb_personnes" 
                                       id="nb_personnes" 
                                       min="1" 
                                       max="{{ $restaurant->capacite_restaurant }}" 
                                       value="{{ old('nb_personnes', 2) }}"
                                       class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nb_personnes') border-red-500 @enderror"
                                       placeholder="Ex: 4"
                                       required>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Capacité max du restaurant : {{ $restaurant->capacite_restaurant ?? 'N/A' }} personnes.</p>
                            @error('nb_personnes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Demande spéciale (Optionnel)</label>
                            <textarea name="message" 
                                      id="message" 
                                      rows="3" 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="Ex: Une chaise haute pour bébé, coin calme..."></textarea>
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t pt-4">
                            <a href="{{ route('restaurants.show', $restaurant->id) }}" class="text-gray-600 hover:text-gray-900 underline text-sm">
                                Annuler
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-150 ease-in-out transform hover:scale-105">
                                ✅ Confirmer la réservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>