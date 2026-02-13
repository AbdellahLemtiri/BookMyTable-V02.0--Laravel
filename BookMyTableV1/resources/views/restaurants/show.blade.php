<x-app-layout>

    {{-- ======================================================================== --}}
    {{-- 🟢 1. PHP LOGIC: جلب أوقات العمل لليوم الحالي --}}
    {{-- ======================================================================== --}}
    @php
        // 1. نجيبو سمية النهار ديال اليوم بالفرنسية (Lundi, Mardi...)
        $currentDayName = now()->locale('fr')->dayName; 
        
        // 2. نقلبو فجدول 'horaires' على التوقيت ديال هاد النهار
        // بما أن العلاقة One-to-Many، كنقلبو فالـ Collection
        $todaySchedule = $restaurant->horaires->filter(function($h) use ($currentDayName) {
            // كنقارنو السمية ديال النهار (strtolower باش نتفاداو مشاكل Majuscule)
            return strtolower($h->jour) === strtolower($currentDayName);
        })->first();

        // 3. واش حال اليوم؟ (كاينة داتا + ما مسدوش 'ferme')
        $isOpenToday = $todaySchedule && !$todaySchedule->ferme;
        
        // 4. تحديد ساعات الفتح والإغلاق (Format H:i -> 09:00)
        $openTime = $todaySchedule ? \Carbon\Carbon::parse($todaySchedule->heure_ouverture)->format('H:i') : null;
        $closeTime = $todaySchedule ? \Carbon\Carbon::parse($todaySchedule->heure_fermeture)->format('H:i') : null;
        
        // 5. الطاقة الاستيعابية (Capacité)
        // كنستعملو 'capacite_restaurant' حسب السكيما ديالك
        $capacity = $restaurant->capacite_restaurant ?? 20; 
    @endphp

    {{-- ======================================================================== --}}
    {{-- 🟠 2. ALPINE.JS LOGIC: Validation & Frontend Logic --}}
    {{-- ======================================================================== --}}
    <div x-data="{ 
        openReservation: false,
        isLoading: false,
        
        // المتغيرات اللي جبنا من PHP
        todayDate: '{{ date('Y-m-d') }}',
        isOpenToday: {{ $isOpenToday ? 'true' : 'false' }},
        openTime: '{{ $openTime }}',
        closeTime: '{{ $closeTime }}',
        capacity: {{ $capacity }},
        
        formData: {
            date: '{{ date('Y-m-d') }}', // التاريخ مبلوكي على اليوم
            time: '',
            guests: 1
        },
        errors: {
            time: '',
            guests: ''
        },
        
        validateAndSubmit() {
            this.errors = { time: '', guests: '' }; 
            let hasError = false;

            // --- A. واش الريسطو حال اليوم؟ ---
            if (!this.isOpenToday) {
                alert('Le restaurant est fermé aujourd\'hui.');
                return;
            }

            // --- B. التحقق من الوقت (Time Validation) ---
            if (!this.formData.time) {
                this.errors.time = 'L\'heure est requise.';
                hasError = true;
            } else {
                // 1. واش الوقت داخل وقت العمل؟
                if (this.formData.time < this.openTime || this.formData.time > this.closeTime) {
                    this.errors.time = 'Horaires d\'aujourd\'hui : ' + this.openTime + ' - ' + this.closeTime;
                    hasError = true;
                } 
                // 2. واش الوقت فات؟ (Déjà passé)
                else {
                    let now = new Date();
                    let currentHour = now.getHours();
                    let currentMinute = now.getMinutes();
                    
                    let [selectedHour, selectedMinute] = this.formData.time.split(':').map(Number);
                    
                    if (selectedHour < currentHour || (selectedHour === currentHour && selectedMinute < currentMinute)) {
                        this.errors.time = 'Cette heure est déjà passée.';
                        hasError = true;
                    }
                }
            }

            // --- C. التحقق من العدد (Capacité) ---
            if (this.formData.guests < 1) {
                this.errors.guests = 'Minimum 1 personne.';
                hasError = true;
            } else if (this.formData.guests > this.capacity) {
                this.errors.guests = 'Maximum ' + this.capacity + ' personnes.';
                hasError = true;
            }

            // --- D. Envoi ---
            if (hasError) return;

            this.isLoading = true;
            this.$refs.reservationForm.submit();
        }
    }">

        {{-- ======================================================================== --}}
        {{-- 🔵 3. UI: INFO RESTAURANT & HEADER --}}
        {{-- ======================================================================== --}}
        
        <section class="mt-4 px-4">
            <div class="flex gap-4 overflow-x-auto no-scrollbar snap-x h-[400px]">
                @if($restaurant->photos->isNotEmpty())
                    @foreach ($restaurant->photos as $photo)
                    <div class="min-w-[70%] md:min-w-[40%] snap-center rounded-[2rem] overflow-hidden border border-white/5">
                        <img src="{{ asset('storage/' . $photo->url_photo) }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                            alt="{{ $restaurant->nom_restaurant }}">
                    </div>
                    @endforeach
                @else
                    <div class="min-w-full h-full rounded-[2rem] bg-white/5 flex items-center justify-center border border-white/10">
                        <p class="text-gray-500 uppercase tracking-widest">Aucune photo disponible</p>
                    </div>
                @endif
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 mt-12 grid grid-cols-1 lg:grid-cols-12 gap-12 relative">

            <div class="lg:col-span-8 space-y-16">
                <div>
                    <span class="text-[#FF5F00] text-[10px] font-black uppercase tracking-[4px]">
                        {{ $restaurant->typeCuisine->nom_type_cuisine ?? 'Cuisine' }}
                    </span>
                    <h2 class="text-6xl font-black uppercase italic tracking-tighter mt-2 mb-6 text-white">
                        {{ $restaurant->nom_restaurant }}<span class="text-[#FF5F00]">.</span>
                    </h2>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-2xl">
                        {{ $restaurant->description_restaurant }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10">
                                <svg class="w-5 h-5 text-[#FF5F00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-gray-500 uppercase tracking-widest">Adresse</p>
                                <p class="text-white text-sm font-bold">{{ $restaurant->adresse_restaurant }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10">
                                <svg class="w-5 h-5 text-[#FF5F00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-gray-500 uppercase tracking-widest">Téléphone</p>
                                <p class="text-white text-sm font-bold">{{ $restaurant->telephone_restaurant }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10">
                                <svg class="w-5 h-5 text-[#FF5F00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-gray-500 uppercase tracking-widest">Capacité</p>
                                <p class="text-white text-sm font-bold">{{ $capacity }} Personnes</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($restaurant->menus && $restaurant->menus->plats->isNotEmpty())
                <div>
                    <h3 class="text-xl font-black uppercase italic mb-8 flex items-center gap-4 text-white">
                        Le Menu <div class="h-[1px] flex-1 bg-white/5"></div>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        @foreach ($restaurant->menus->plats as $plat)
                        <div class="flex justify-between items-end border-b border-white/5 pb-4 group cursor-default">
                            <div class="flex-1">
                                <h4 class="text-white font-bold text-sm uppercase group-hover:text-[#FF5F00] transition-colors duration-300">
                                    {{ $plat->nom_plat }}
                                </h4>
                            </div>
                            <span class="text-[#FF5F00] font-black text-sm ml-4">{{ number_format($plat->prix_plat, 0) }} DH</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="border border-dashed border-white/10 rounded-2xl p-12 text-center bg-white/5">
                    <p class="text-gray-500 text-xs uppercase tracking-widest">Menu non disponible</p>
                </div>
                @endif
            </div>

            <div class="lg:col-span-4 space-y-8">
                <div class="backdrop-blur-md bg-white/5 p-8 rounded-[2rem] border border-white/10 shadow-2xl">
                    <h4 class="text-xs font-black uppercase tracking-[2px] mb-6 text-[#FF5F00]">Horaires d'ouverture</h4>
                    <div class="space-y-3 text-[11px] font-bold uppercase tracking-widest text-gray-400">
                        @php
                            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                        @endphp

                        @foreach ($jours as $jour)
                            @php
                                // البحث عن اليوم في الجدول
                                $horaire = $restaurant->horaires->firstWhere(function($h) use ($jour) {
                                    return strtolower($h->jour) === strtolower($jour);
                                });
                            @endphp
                            <div class="flex justify-between border-b border-white/5 pb-2 {{ strtolower($jour) === strtolower($currentDayName) ? 'text-white' : '' }}">
                                <span class="{{ strtolower($jour) === strtolower($currentDayName) ? 'text-[#FF5F00] font-black' : '' }}">{{ $jour }}</span>
                                @if ($horaire && !$horaire->ferme)
                                    <span class="{{ strtolower($jour) === strtolower($currentDayName) ? 'text-white font-bold' : 'text-gray-500' }}">
                                        {{ \Carbon\Carbon::parse($horaire->heure_ouverture)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($horaire->heure_fermeture)->format('H:i') }}
                                    </span>
                                @else
                                    <span class="text-red-500/70">Fermé</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                @role('client')
                    <button @click="openReservation = true"
                        class="block w-full bg-white text-black font-black py-5 rounded-2xl uppercase tracking-[3px] text-[11px] hover:bg-[#FF5F00] hover:text-white transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_30px_rgba(255,95,0,0.4)] text-center transform hover:-translate-y-1">
                        Réserver pour Aujourd'hui
                    </button>
                @endrole
                
                @role('client')
                    <a href="mailto:{{ $restaurant->email_restaurant }}"
                        class="block w-full bg-transparent border border-white/10 text-white font-black py-4 rounded-2xl uppercase tracking-[3px] text-[10px] hover:border-[#FF5F00] hover:text-[#FF5F00] transition-all text-center">
                        Nous Contacter
                    </a>
                @endrole
            </div>

        </section>


        {{-- ======================================================================== --}}
        {{-- 🟣 4. MODAL DE RÉSERVATION (POP-UP) --}}
        {{-- ======================================================================== --}}
        <div x-show="openReservation" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6">

            <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" @click="openReservation = false"></div>

            <div class="relative bg-[#0f0f0f] border border-white/10 rounded-[2rem] w-full max-w-lg p-8 shadow-2xl overflow-hidden transform"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                
                <button @click="openReservation = false" class="absolute top-4 right-4 text-gray-500 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="text-center mb-8">
                    <p class="text-[#FF5F00] text-[10px] font-black uppercase tracking-[3px] mb-2">Réserver chez</p>
                    <h3 class="text-3xl font-black uppercase italic text-white">{{ $restaurant->nom_restaurant }}<span class="text-[#FF5F00]">.</span></h3>
                    
                    @if($isOpenToday)
                        <div class="inline-block mt-3 px-3 py-1 rounded-full bg-green-500/10 border border-green-500/20">
                            <p class="text-green-500 text-[10px] uppercase font-bold tracking-wider">
                                Ouvert aujourd'hui • {{ $openTime }} - {{ $closeTime }}
                            </p>
                        </div>
                    @else
                        <div class="inline-block mt-3 px-3 py-1 rounded-full bg-red-500/10 border border-red-500/20">
                            <p class="text-red-500 text-[10px] uppercase font-bold tracking-wider">
                                Fermé aujourd'hui
                            </p>
                        </div>
                    @endif
                </div>

                <form x-ref="reservationForm" action="{{ route('reservations.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="col-span-2 sm:col-span-1">
                            <label class="block text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-2">Date</label>
                            <input type="date" name="date_reservation" x-model="formData.date" 
                                readonly 
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 cursor-not-allowed text-sm focus:border-white/10 outline-none">
                            <p class="text-[9px] text-gray-600 mt-1">Réservation possible uniquement pour aujourd'hui.</p>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label class="block text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-2">Heure</label>
                            <input type="time" name="heure_reservation" x-model="formData.time"
                                :class="{'border-red-500': errors.time, 'border-white/10': !errors.time}"
                                class="w-full bg-white/5 border rounded-xl px-4 py-3 text-white text-sm focus:border-[#FF5F00] focus:ring-1 focus:ring-[#FF5F00] outline-none transition-all">
                            <p x-show="errors.time" x-text="errors.time" class="text-red-500 text-[9px] mt-1 font-bold tracking-wider"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-2">Invités</label>
                        <div class="relative">
                            <input type="number" name="nb_personnes" x-model="formData.guests" min="1" max="{{ $capacity }}" 
                                :class="{'border-red-500': errors.guests, 'border-white/10': !errors.guests}"
                                class="w-full bg-white/5 border rounded-xl px-4 py-3 text-white text-sm focus:border-[#FF5F00] focus:ring-1 focus:ring-[#FF5F00] outline-none transition-all placeholder-gray-600">
                        </div>
                        <p x-show="errors.guests" x-text="errors.guests" class="text-red-500 text-[9px] mt-1 font-bold tracking-wider"></p>
                        <p class="text-[9px] text-gray-500 mt-2 text-right">Capacité max: {{ $capacity }} pers.</p>
                    </div>

                    <button type="button" 
                        @click="validateAndSubmit()"
                        :disabled="isLoading || !isOpenToday" 
                        :class="!isOpenToday ? 'opacity-50 cursor-not-allowed bg-gray-600' : 'bg-[#FF5F00] hover:bg-[#e05300] shadow-[0_4px_15px_rgba(255,95,0,0.3)] hover:shadow-[0_6px_20px_rgba(255,95,0,0.5)]'"
                        class="w-full mt-4 text-white font-black py-4 rounded-xl uppercase tracking-[3px] text-xs transition-all transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                        
                        <span x-show="!isLoading && isOpenToday">Confirmer la réservation</span>
                        <span x-show="!isOpenToday">Fermé Aujourd'hui</span>
                        
                        <span x-show="isLoading" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Traitement...
                        </span>
                    </button>
                    
                    <div class="text-center mt-4">
                        <button type="button" @click="openReservation = false" class="text-gray-500 text-xs hover:text-white underline decoration-1 underline-offset-4">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>