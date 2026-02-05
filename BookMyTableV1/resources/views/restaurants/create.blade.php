<x-app-layout>
    <div class="min-h-screen bg-[#050505] py-12 px-4">

        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-12 text-center">
            <h1 class="text-5xl font-black italic uppercase text-white mb-3">
                Nouveau Restaurant<span class="text-[#FF5F00]">.</span>
            </h1>
            <p class="text-gray-500 text-sm uppercase tracking-widest">Remplissez tous les détails ci-dessous</p>
        </div>

        <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-7xl mx-auto">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- LEFT COLUMN -->
                <div class="space-y-6">

                    <!-- SECTION 1: Informations de base -->
                    <div class="bg-[#0A0A0A] border border-white/5 p-8 rounded-3xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-8 h-8 rounded-full bg-[#FF5F00] text-white flex items-center justify-center font-black text-sm">
                                1</div>
                            <h3 class="text-white text-lg font-black italic uppercase">Informations de base<span
                                    class="text-[#FF5F00]">.</span></h3>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-[9px] text-gray-500 font-black uppercase tracking-[2px]">Nom du
                                    Restaurant</label>
                                <input type="text" name="nom_restaurant" required
                                    class="w-full bg-[#111] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-[#FF5F00] transition-all outline-none">
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[9px] text-gray-500 font-black uppercase tracking-[2px]">Ville</label>
                                <input type="text" name="adresse_restaurant" required
                                    class="w-full bg-[#111] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-[#FF5F00] transition-all outline-none">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[9px] text-gray-500 font-black uppercase tracking-[2px]">Type de
                                    Cuisine</label>
                                <select name="type_cuisine_id" required
                                    class="w-full bg-[#111] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-[#FF5F00] transition-all outline-none">
                                    <option value="" disabled selected>Choisir un type</option>
                                    @foreach ($type_cuisines as $type)
                                        <option value="{{ $type->id }}">{{ $type->nom_type_cuisine }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label
                                        class="text-[9px] text-gray-500 font-black uppercase tracking-[2px]">Email</label>
                                    <input type="email" name="email_restaurant" required
                                        class="w-full bg-[#111] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-[#FF5F00] transition-all outline-none">
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-[9px] text-gray-500 font-black uppercase tracking-[2px]">Téléphone</label>
                                    <input type="text" name="telephone_restaurant" required
                                        class="w-full bg-[#111] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-[#FF5F00] transition-all outline-none">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[9px] text-gray-500 font-black uppercase tracking-[2px]">Capacité</label>
                                <input type="number" name="capacity" required
                                    class="w-full bg-[#111] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-[#FF5F00] transition-all outline-none">
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[9px] text-gray-500 font-black uppercase tracking-[2px]">Description</label>
                                <textarea name="description_restaurant" rows="3" required
                                    class="w-full bg-[#111] border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-[#FF5F00] transition-all outline-none resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: Galerie Photos -->
                    <div class="bg-[#0A0A0A] border border-white/5 p-8 rounded-3xl">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-[#FF5F00] text-white flex items-center justify-center font-black text-sm">
                                    3</div>
                                <h3 class="text-white text-lg font-black italic uppercase">Galerie Photos<span
                                        class="text-[#FF5F00]">.</span></h3>
                            </div>
                            <button type="button" onclick="addImageInput()"
                                class="text-[8px] bg-[#FF5F00] text-white px-3 py-1.5 rounded-full font-black uppercase tracking-widest hover:bg-[#ff7a2e] transition-all">+
                                Photo</button>
                        </div>

                        <div id="images-container" class="grid grid-cols-3 gap-3">
                            <div class="relative h-28 group">
                                <label
                                    class="block w-full h-full border-2 border-dashed border-white/10 rounded-xl cursor-pointer hover:border-[#FF5F00]/50 overflow-hidden bg-[#111] transition-all">
                                    <input type="file" name="image_principal" class="hidden"
                                        onchange="previewImage(this)">
                                    <img class="image-preview hidden w-full h-full object-cover">
                                    <div
                                        class="preview-placeholder flex items-center justify-center h-full text-gray-600 text-[7px] font-black uppercase tracking-widest">
                                        Main</div>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="space-y-6">

                    <!-- SECTION 2: Horaires -->
                    <div class="bg-[#0A0A0A] border border-white/5 p-8 rounded-3xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-8 h-8 rounded-full bg-[#FF5F00] text-white flex items-center justify-center font-black text-sm">
                                2</div>
                            <h3 class="text-white text-lg font-black italic uppercase">Horaires<span
                                    class="text-[#FF5F00]">.</span></h3>
                        </div>

                        <div class="space-y-3">
                            @foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $day)
                                <div class="flex items-center gap-3" x-data="{ closed: false }">
                                    <div class="w-20 text-[9px] font-black uppercase text-gray-500"
                                        :class="closed ? 'line-through opacity-30' : ''">{{ $day }}</div>
                                    <input type="time" name="schedule[{{ strtolower($day) }}][open]"
                                        :disabled="closed"
                                        class="flex-1 bg-black/40 border border-white/5 rounded-lg px-3 py-2 text-[11px] text-white focus:border-[#FF5F00] outline-none">
                                    <input type="time" name="schedule[{{ strtolower($day) }}][close]"
                                        :disabled="closed"
                                        class="flex-1 bg-black/40 border border-white/5 rounded-lg px-3 py-2 text-[11px] text-white focus:border-[#FF5F00] outline-none">
                                    <input type="checkbox" @change="closed = !closed"  
                                        class="rounded bg-white/5 border-white/10 text-[#FF5F00] focus:ring-[#FF5F00] w-4 h-4">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- SECTION 4: Menu -->
                    <div class="bg-[#0A0A0A] border border-white/5 p-8 rounded-3xl">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-[#FF5F00] text-white flex items-center justify-center font-black text-sm">
                                    4</div>
                                <h3 class="text-white text-lg font-black italic uppercase">Le Menu<span
                                        class="text-[#FF5F00]">.</span></h3>
                            </div>
                            <button type="button" onclick="addMenuRow()"
                                class="text-[8px] bg-[#FF5F00] text-white px-3 py-1.5 rounded-full font-black uppercase tracking-widest hover:bg-[#ff7a2e] transition-all">+
                                Plat</button>
                        </div>

                        <div id="menu-container" class="space-y-2">
                            <div class="flex gap-3">
                                <input type="text" name="menu[0][nom_plat]" placeholder="Nom du plat"
                                    class="flex-1 bg-[#111] border border-white/5 rounded-lg px-4 py-2.5 text-xs text-white focus:border-[#FF5F00] outline-none transition-all">
                                <input type="number" name="menu[0][prix_plat]" placeholder="Prix"
                                    class="w-20 bg-[#111] border border-white/5 rounded-lg px-3 py-2.5 text-xs text-white focus:border-[#FF5F00] outline-none transition-all">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-[#FF5F00] text-white font-black py-5 rounded-2xl uppercase tracking-widest text-xs shadow-2xl shadow-[#FF5F00]/20 hover:bg-[#ff7a2e] transition-all">
                    Finaliser & Publier ✓
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const label = input.parentElement;
                    const img = label.querySelector('.image-preview');
                    const ph = label.querySelector('.preview-placeholder');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                    ph.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function addImageInput() {
            const container = document.getElementById('images-container');
            const div = document.createElement('div');
            div.className = 'relative h-28 group';
            div.innerHTML = `
                <label class="block w-full h-full border-2 border-dashed border-white/10 rounded-xl cursor-pointer hover:border-[#FF5F00]/50 overflow-hidden bg-[#111] transition-all">
                    <input type="file" name="images[${container.children.length}]" class="hidden" onchange="previewImage(this)">
                    <img class="image-preview hidden w-full h-full object-cover">
                    <div class="preview-placeholder flex items-center justify-center h-full text-gray-600 text-[7px] font-black uppercase tracking-widest">+</div>
                </label>
                <button type="button" onclick="this.parentElement.remove()" 
                    class="absolute -top-1 -right-1 bg-red-600 hover:bg-red-500 text-white rounded-full w-5 h-5 text-xs font-bold transition-all">×</button>
            `;
            container.appendChild(div);
        }

        let menuIdx = 1;

        function addMenuRow() {
            const container = document.getElementById('menu-container');
            const div = document.createElement('div');
            div.className = 'flex gap-3';
            div.innerHTML = `
                <input type="text" name="menu[${menuIdx}][nom_plat]" placeholder="Nom du plat" 
                    class="flex-1 bg-[#111] border border-white/5 rounded-lg px-4 py-2.5 text-xs text-white outline-none focus:border-[#FF5F00] transition-all">
                <input type="number" name="menu[${menuIdx}][prix_plat]" placeholder="Prix" 
                    class="w-20 bg-[#111] border border-white/5 rounded-lg px-3 py-2.5 text-xs text-white outline-none focus:border-[#FF5F00] transition-all">
                <button type="button" onclick="this.parentElement.remove()" 
                    class="text-red-500 hover:text-red-400 font-bold px-2 transition-colors text-lg">×</button>
            `;
            container.appendChild(div);
            menuIdx++;
        }
    </script>
</x-app-layout>
