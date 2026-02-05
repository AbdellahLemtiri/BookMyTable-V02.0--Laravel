<x-app-layout>
    <!-- Success Message -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-4 right-4 bg-[#FF5F00] text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest shadow-2xl z-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center p-6 bg-[#050505] text-white">
        <div class="w-full max-w-5xl flex flex-col md:flex-row gap-12 items-center md:items-start">

            <!-- LEFT COLUMN - Avatar & User Info -->
            <div class="md:w-1/3 flex flex-col items-center">
                <div class="relative group">
                    <!-- Avatar Display -->
                    <div
                        class="w-48 h-48 rounded-full overflow-hidden border-4 border-white/5 transition-all duration-500 group-hover:border-[#FF5F00]/50 group-hover:scale-105">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) . '&background=FF5F00&color=fff&size=200' }}"
                            class="w-full h-full object-cover" alt="Avatar">
                    </div>

                    <!-- Upload Avatar Button -->
                    <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data"
                        id="avatarForm">
                        @csrf
                        @method('PUT')
                        <label
                            class="absolute bottom-4 right-4 bg-[#FF5F00] p-3 rounded-full cursor-pointer hover:scale-110 transition-all shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input type="file" name="avatar" accept="image/*" class="hidden"
                                onchange="document.getElementById('avatarForm').submit()">
                        </label>
                    </form>
                </div>

                <!-- User Info -->
                <div class="mt-8 text-center">
                    <h2 class="text-3xl font-black italic uppercase tracking-tighter">
                        {{ Auth::user()->username }}
                    </h2>
                    <div class="mt-3">
                        <span
                            class="px-4 py-1.5 bg-[#FF5F00]/10 text-[#FF5F00] text-[10px] font-black uppercase tracking-[2px] rounded-full border border-[#FF5F00]/20">
                            {{ ucfirst(Auth::user()->role ?? 'Client') }}
                        </span>
                    </div>
                    <p class="text-gray-600 text-[10px] mt-6 font-bold tracking-[4px] uppercase italic">
                        Member since {{ Auth::user()->created_at->format('Y') }}
                    </p>

                </div>

                <!-- Delete Account -->
                <div class="mt-10 w-full">
                    <button onclick="openDeleteAccountModal()"
                        class="w-full bg-red-500/10 border border-red-500/20 text-red-500 text-[10px] font-black uppercase tracking-[2px] py-3 rounded-xl hover:bg-red-500/20 transition-all">
                        Delete Account
                    </button>
                </div>
            </div>

            <!-- RIGHT COLUMN - Profile Form -->
            <div
                class="md:w-2/3 bg-[#0A0A0A] border border-white/5 rounded-3xl p-10 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-[#FF5F00]/5 rounded-full blur-3xl"></div>

                <h3 class="text-xl font-black uppercase tracking-[4px] mb-10 border-b border-white/5 pb-6">
                    Account Settings<span class="text-[#FF5F00]">.</span>
                </h3>

                <form action="{{ route('profile.update') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf
                    @method('PATCH')

                    <!-- nom complete -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] text-gray-500 font-black uppercase tracking-[3px]">Nom</label>
                        <input type="text" name="username" value="{{ old('nom', Auth::user()->username) }}"
                            class="w-full bg-[#111] border border-white/10 rounded-xl px-5 py-4 text-sm text-white outline-none focus:border-[#FF5F00] transition-all">
                        <x-input-error class="mt-2" :messages="$errors->get('username')" />
                    </div>



                    <!-- Email (Read-only) -->
                    <div class="space-y-2">
                        <label class="text-[10px] text-gray-500 font-black uppercase tracking-[3px]">Email
                            Address</label>
                        <input type="email" value="{{ Auth::user()->email }}" readonly
                            class="w-full bg-black/40 border border-white/5 rounded-xl px-5 py-4 text-sm text-gray-600 outline-none cursor-not-allowed italic">
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2">
                        <label class="text-[10px] text-gray-500 font-black uppercase tracking-[3px]">Mobile
                            Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                            placeholder="+212 ..."
                            class="w-full bg-[#111] border border-white/10 rounded-xl px-5 py-4 text-sm text-white outline-none focus:border-[#FF5F00] transition-all">
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <!-- Address -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] text-gray-500 font-black uppercase tracking-[3px]">Address</label>
                        <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}"
                            placeholder="Rue, Ville, Code Postal"
                            class="w-full bg-[#111] border border-white/10 rounded-xl px-5 py-4 text-sm text-white outline-none focus:border-[#FF5F00] transition-all">
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <!-- Account Status -->
                    <div class="md:col-span-2 flex items-center gap-3 py-4">
                        <div class="relative flex h-3 w-3">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </div>
                        <span class="text-[10px] text-gray-500 uppercase font-black tracking-[2px]">Account Status:
                            <span class="text-white">{{ ucfirst(Auth::user()->status ?? 'Active') }}</span>
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="md:col-span-2 pt-6 flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="bg-[#FF5F00] hover:bg-[#E65600] text-white text-[11px] font-black px-10 py-5 rounded-xl uppercase tracking-[3px] transition-all transform active:scale-95 shadow-2xl shadow-[#FF5F00]/20">
                            Save Changes
                        </button>

                        @role('restaurateur')
                            <a href="{{ route('restaurateur.dashboard') }}"
                                class="inline-flex justify-center items-center bg-white/5 hover:bg-white/10 text-white text-[11px] font-black px-10 py-5 rounded-xl uppercase tracking-[3px] transition-all border border-white/5">
                                Cancel
                            </a>
                        @endrole

                        @role('client')
                            <a href="{{ route('home') }}"
                                class="inline-flex justify-center items-center bg-white/5 hover:bg-white/10 text-white text-[11px] font-black px-10 py-5 rounded-xl uppercase tracking-[3px] transition-all border border-white/5">
                                Cancel
                            </a>
                        @endrole

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                class="text-sm text-[#FF5F00] font-bold self-center animate-pulse">
                                Updated Successfully
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DELETE ACCOUNT MODAL -->
    <div id="deleteAccountModal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-50">
        <div
            class="bg-[#0A0A0A] border-2 border-red-500/30 rounded-2xl p-8 max-w-md w-full mx-4 relative overflow-hidden">

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
                    Delete Account<span class="text-red-500">?</span>
                </h3>
                <p class="text-sm text-gray-400 mb-2">Cette action est irréversible</p>
                <p class="text-xs text-gray-500 mt-4">Entrez votre mot de passe pour confirmer</p>
            </div>

            <!-- Delete Form -->
            <form action="{{ route('profile.destroy') }}" method="POST" class="space-y-4">
                @csrf
                @method('DELETE')

                <div class="space-y-2">
                    <input type="password" name="password" placeholder="Mot de passe" required
                        class="w-full bg-[#111] border border-white/10 rounded-xl px-5 py-4 text-sm text-white outline-none focus:border-red-500 transition-all">
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeDeleteAccountModal()"
                        class="flex-1 bg-white/5 border border-white/10 text-white font-black uppercase text-[10px] tracking-widest py-4 rounded-lg hover:bg-white/10 transition-all">
                        Annuler
                    </button>
                    <button type="submit"
                        class="flex-1 bg-red-500 text-white font-black uppercase text-[10px] tracking-widest py-4 rounded-lg hover:bg-red-600 transition-all">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteAccountModal() {
            document.getElementById('deleteAccountModal').classList.remove('hidden');
            document.getElementById('deleteAccountModal').classList.add('flex');
        }

        function closeDeleteAccountModal() {
            document.getElementById('deleteAccountModal').classList.add('hidden');
            document.getElementById('deleteAccountModal').classList.remove('flex');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteAccountModal();
            }
        });

        // Close modal on backdrop click
        document.getElementById('deleteAccountModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteAccountModal();
            }
        });
    </script>
</x-app-layout>
