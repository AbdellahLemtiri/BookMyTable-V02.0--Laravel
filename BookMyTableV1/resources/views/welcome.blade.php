<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youco'Done | Welcome</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #000;
        }

        .image-side {
            background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=1470&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(255, 95, 0, 0.4);
        }
    </style>
</head>

<body class="min-h-screen flex items-stretch overflow-hidden">

    <div class="hidden lg:block lg:w-[60%] image-side relative">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute bottom-20 left-20">
            <h1 class="text-white text-7xl font-black tracking-tighter leading-none text-glow">
                BOOK YOUR <br><span class="text-[#FF5F00]">MOMENT.</span>
            </h1>
        </div>
    </div>

    <div class="w-full lg:w-[40%] bg-[#0A0A0A] flex items-center justify-center p-8 border-l border-white/5">

        <div class="w-full max-w-[340px]">

            <div class="mb-16">
                <h2 class="text-white text-2xl font-black tracking-tighter italic">
                    YOUCO<span class="text-[#FF5F00]">DONE.</span>
                </h2>
                <div class="w-8 h-[2px] bg-[#FF5F00] mt-1"></div>
            </div>

            <div class="space-y-6">
                <div class="space-y-2">
                    <h3 class="text-white text-xl font-bold">La gastronomie à portée de clic.</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Que vous soyez un amateur de bonne cuisine ou un restaurateur passionné, Youco'Done simplifie
                        vos réservations.
                    </p>
                </div>

                <div class="space-y-4 py-6">
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-2 h-2 rounded-full bg-[#FF5F00]"></div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Réservation instantanée
                        </p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-2 h-2 rounded-full bg-[#FF5F00]"></div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Gestion simplifiée</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-2 h-2 rounded-full bg-[#FF5F00]"></div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Expérience Premium</p>
                    </div>
                </div>

                <div class="pt-6 space-y-3">
                    @if (Route::has('login'))
                        @auth
                            @role('restaurateur')
                                <a href="{{ route('restaurateur.dashboard') }}"
                                    class="flex justify-center w-full bg-[#FF5F00] text-white text-[11px] font-black py-4 rounded-lg shadow-lg shadow-[#FF5F00]/10 uppercase tracking-[2px] transition-all hover:bg-[#E65600]">
                                    Aller au Dashboard
                                </a>
                            @endrole
                            @role('client')
                                <a href="{{ route('home') }}"
                                    class="flex justify-center w-full bg-[#FF5F00] text-white text-[11px] font-black py-4 rounded-lg shadow-lg shadow-[#FF5F00]/10 uppercase tracking-[2px] transition-all hover:bg-[#E65600]">
                                    Aller au page accuielle </a>
                            @endrole
                            @role('admin')
                                <a href="{{ route('admin.restaurants') }}"
                                    class="flex justify-center w-full bg-[#FF5F00] text-white text-[11px] font-black py-4 rounded-lg shadow-lg shadow-[#FF5F00]/10 uppercase tracking-[2px] transition-all hover:bg-[#E65600]">
                                    Aller au Dashboard Admin </a>
                            @endrole
                        @else
                            <a href="{{ route('login') }}"
                                class="flex justify-center w-full bg-[#FF5F00] text-white text-[11px] font-black py-4 rounded-lg shadow-lg shadow-[#FF5F00]/10 uppercase tracking-[2px] transition-all hover:bg-[#E65600]">
                                Commencer maintenant
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="flex justify-center w-full bg-transparent border border-white/10 text-white text-[11px] font-black py-4 rounded-lg uppercase tracking-[2px] transition-all hover:bg-white/5">
                                    Créer un compte
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="mt-20">
                <p class="text-[10px] text-gray-700 uppercase font-bold tracking-[3px]">© 2024 Youco'Done Studio.</p>
            </div>

        </div>
    </div>

</body>

</html>
