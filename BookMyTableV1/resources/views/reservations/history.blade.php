<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="max-w-5xl mx-auto">
            
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-black uppercase italic text-white tracking-tighter">
                    Mes Réservations<span class="text-[#FF5F00]">.</span>
                </h2>
                <a href="{{ route('home') }}" class="text-xs font-bold text-gray-400 hover:text-white uppercase tracking-widest transition-colors">
                    + Réserver encore
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                @forelse ($reservations as $reservation)
                    {{-- Carte Réservation --}}
                    <div class="group relative bg-[#1a1a1a] rounded-3xl overflow-hidden border border-white/5 hover:border-[#FF5F00]/50 transition-all duration-300 hover:-translate-y-1">
                        
                        {{-- Image Restaurant (Background flou) --}}
                        <div class="absolute inset-0 z-0">
                            @if($reservation->restaurant->photos->isNotEmpty())
                                <img src="{{ asset('storage/' . $reservation->restaurant->photos->first()->url_photo) }}" 
                                     class="w-full h-full object-cover opacity-20 group-hover:opacity-30 transition-opacity duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-800 to-black opacity-50"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a1a] via-[#1a1a1a]/80 to-transparent"></div>
                        </div>

                        {{-- Contenu --}}
                        <div class="relative z-10 p-6 flex flex-col h-full justify-between">
                            
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-black uppercase italic text-white group-hover:text-[#FF5F00] transition-colors">
                                        {{ $reservation->restaurant->nom_restaurant }}
                                    </h3>
                                    
                                    {{-- Badge Statut --}}
                                    @php
                                        $statusClasses = match($reservation->statut) {
                                            'payee' => 'bg-green-500/10 text-green-500 border-green-500/20',
                                            'annulee' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                            'en_attente' => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                                            default => 'bg-gray-500/10 text-gray-500 border-gray-500/20',
                                        };
                                        $statusLabel = match($reservation->statut) {
                                            'payee' => 'Confirmée',
                                            'annulee' => 'Annulée',
                                            'en_attente' => 'La facture n\'a pas été réglée',
                                            default => $reservation->statut,
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $statusClasses }}">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-xs font-bold uppercase tracking-wide">
                                            {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-xs font-bold uppercase tracking-wide">
                                            {{ \Carbon\Carbon::parse($reservation->heure_reservation)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-white/10 flex items-end justify-between">
                                <div>
                                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Total</p>
                                    <p class="text-white font-bold text-lg">{{ number_format($reservation->total_price, 0) }} <span class="text-xs text-[#FF5F00]">DH</span></p>
                                </div>
                          
                                @if($reservation->statut === 'payee')
                                    <a href="{{ route('reservations.success', $reservation->id) }}" class="px-4 py-2 bg-white/5 hover:bg-white/10 rounded-lg text-xs font-bold uppercase tracking-wider text-white border border-white/10 transition-colors">
                                        Voir le ticket
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>

                @empty
                   
                    <div class="col-span-1 md:col-span-2 text-center py-20 border border-dashed border-white/10 rounded-3xl bg-white/5">
                        <div class="w-16 h-16 mx-auto bg-gray-800 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Aucune réservation</h3>
                        <p class="text-gray-500 text-sm mb-6">Vous n'avez pas encore réservé de table.</p>
                        <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-[#FF5F00] text-white font-black rounded-xl uppercase tracking-widest text-xs hover:bg-[#e05300] transition-colors">
                            Découvrir nos restaurants
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>