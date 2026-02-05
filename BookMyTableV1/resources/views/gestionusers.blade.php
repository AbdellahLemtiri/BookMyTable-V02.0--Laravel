<x-app-layout>
    <div class="bg-black min-h-screen pb-20">
        <div class="border-b border-white/10 py-12 bg-[#050505]">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 bg-red-600"></span>
                        <p class="text-red-600 font-bold uppercase tracking-[4px] text-[10px]">Security & Permissions</p>
                    </div>
                    <h1 class="text-4xl font-black italic uppercase text-white tracking-tighter">User <span
                            class="text-white/20">Management.</span></h1>
                </div>

                <div class="flex gap-4">
                    <div class="bg-[#0A0A0A] border border-white/10 p-5 min-w-[140px]">
                        <p class="text-gray-500 text-[8px] font-black uppercase tracking-widest mb-1">Total Members</p>
                        <p class="text-xl font-black text-white leading-none italic">{{ $users->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white text-[11px] font-black uppercase tracking-[5px]">Liste des utilisateurs</h2>
                <div class="flex gap-2 text-gray-600 text-[10px] uppercase font-bold italic">
                    Contrôle total des privilèges
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 border border-white/5">
                @foreach ($users as $user)
                    <div
                        class="bg-[#0A0A0A] border border-white/5 aspect-square flex flex-col group relative p-8 justify-between hover:bg-[#0f0f0f] transition-all">

                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="w-12 h-12 bg-white/5 border border-white/10 flex items-center justify-center font-black text-white text-xs uppercase">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <span
                                    class="text-[8px] font-black px-2 py-1 uppercase tracking-tighter 
                                    {{ $user->role === 'admin' ? 'bg-red-600 text-white' : ($user->role === 'restaurateur' ? 'bg-[#FF5F00] text-black' : 'bg-white text-black') }}">
                                    {{ $user->role }}



                                </span>
                            </div>

                            <h3 class="text-lg font-black text-white uppercase italic leading-tight truncate">
                                {{ $user->username }}</h3>
                            <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mt-1 truncate">
                                {{ $user->email }}</p>
                        </div>

                        <div class="space-y-4">
                            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                @csrf @method('PATCH')
                                <select name="role" onchange="this.form.submit()"
                                    class="w-full bg-black border border-white/10 text-gray-400 text-[9px] font-black uppercase tracking-widest focus:ring-0 focus:border-[#FF5F00] py-2 px-3 appearance-none cursor-pointer">
                                    <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Set as
                                        Client</option>
                                    <option value="restaurateur" {{ $user->role === 'restaurateur' ? 'selected' : '' }}>
                                        Set as Restaurateur</option>
                                    <option value="visiteur" {{ $user->role === 'visiteur' ? 'selected' : '' }}>BAN ACCOUNT
                                    </option>
                                </select>
                            </form>

                          
                        </div>
                        <div
                            class="absolute inset-0 border border-white/20 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
