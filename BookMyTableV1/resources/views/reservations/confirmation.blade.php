<x-app-layout>
    <div class="min-h-screen bg-black flex items-center justify-center p-4">
        
        <div class="max-w-md w-full bg-[#1a1a1a] rounded-3xl overflow-hidden shadow-2xl border border-white/10 relative">
            
            {{-- تأثير الإضاءة الفوق --}}
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-[#FF5F00] to-transparent opacity-70"></div>

            <div class="p-8 text-center">
                <div class="mx-auto w-20 h-20 bg-green-500/10 rounded-full flex items-center justify-center mb-6 border border-green-500/20 animate-bounce">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="text-3xl font-black uppercase italic text-white mb-2">Paiement Réussi !</h2>
                <p class="text-gray-400 text-sm mb-8">
                    Merci <span class="text-[#FF5F00] font-bold">{{ auth()->user()->name }}</span>, votre réservation est confirmée.
                </p>

                <div class="bg-white/5 rounded-2xl p-6 border border-white/10 relative text-left">
                    
                    {{-- ثقوب التيكة (Deco) --}}
                    <div class="absolute -left-3 top-1/2 w-6 h-6 bg-[#1a1a1a] rounded-full transform -translate-y-1/2"></div>
                    <div class="absolute -right-3 top-1/2 w-6 h-6 bg-[#1a1a1a] rounded-full transform -translate-y-1/2"></div>
                    <div class="absolute left-4 right-4 top-1/2 border-t-2 border-dashed border-white/10 transform -translate-y-1/2"></div>

                    <div class="space-y-3 pb-8">
                        <div>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest">Restaurant</p>
                            <p class="text-white font-bold text-lg">{{ $reservation->restaurant->nom_restaurant }}</p>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest">Date</p>
                                <p class="text-white font-bold">{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest">Heure</p>
                                <p class="text-white font-bold">{{ \Carbon\Carbon::parse($reservation->heure_reservation)->format('H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest">Invités</p>
                                <p class="text-white font-bold">{{ $reservation->nb_personnes }} Personnes</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest">Statut</p>
                                <span class="px-2 py-1 rounded bg-green-500/20 text-green-500 text-[10px] font-bold uppercase border border-green-500/20">
                                    {{ $reservation->statut }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/5 flex justify-between items-center">
                            <span class="text-gray-400 text-xs uppercase">Total Payé</span>
                            <span class="text-[#FF5F00] font-black text-2xl">{{ number_format($reservation->total_price, 2) }} DH</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 pt-0 space-y-3">
                <button onclick="window.print()" class="w-full py-4 rounded-xl border border-white/10 text-gray-400 font-bold uppercase tracking-widest text-[10px] hover:bg-white/5 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Imprimer le reçu
                </button>

                <a href="{{ route('home') }}" class="block w-full bg-[#FF5F00] text-white font-black py-4 rounded-xl text-center uppercase tracking-[3px] text-xs hover:bg-[#e05300] transition-all shadow-lg hover:shadow-orange-500/20">
                    Retour à l'accueil
                </a>
            </div>

        </div>
    </div>
</x-app-layout>