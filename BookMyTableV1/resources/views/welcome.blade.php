<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Youco'Done • Réservez l’exception</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --accent: #FF5F00;
      --accent-dark: #E04E00;
    }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: #000;
      color: #f5f5f5;
    }

    .serif {
      font-family: 'Playfair Display', serif;
    }

    .image-hero {
      background-image: linear-gradient(to bottom, rgba(0,0,0,0.15), rgba(0,0,0,0.82)),
                        url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&q=85&w=1600');
      background-size: cover;
      background-position: center 35%;
    }

    .glow {
      text-shadow: 0 0 40px rgba(255, 95, 0, 0.25);
    }

    .btn-primary {
      background: var(--accent);
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-primary:hover {
      background: var(--accent-dark);
      transform: translateY(-3px);
      box-shadow: 0 25px 40px -12px rgba(255, 95, 0, 0.38);
    }

    .btn-outline {
      border: 1px solid rgba(255,255,255,0.12);
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-outline:hover {
      background: rgba(255,255,255,0.06);
      border-color: rgba(255,255,255,0.3);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col lg:flex-row">

  <!-- Hero image – visible uniquement sur grand écran -->
  <div class="hidden lg:block lg:w-3/5 image-hero relative">

    <div class="absolute inset-0 flex items-end pb-24 px-16 lg:px-24">
      <div class="max-w-3xl">
        <h1 class="serif text-6xl lg:text-8xl font-semibold leading-none tracking-[-1.5px] glow">
          Une table.<br>Une expérience.
        </h1>
        <p class="mt-8 text-xl lg:text-2xl text-gray-200 font-light max-w-lg">
          Réservez les meilleures adresses gastronomiques en un clic.
        </p>
      </div>
    </div>
  </div>

  <!-- Contenu principal (login / welcome) -->
  <div class="flex-1 flex items-center justify-center px-6 py-16 lg:py-0 lg:px-12 bg-gradient-to-b from-black to-[#0A0A0A]">

    <div class="w-full max-w-md space-y-12 lg:space-y-16">

      <!-- Logo -->
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#FF5F00] to-[#FF8533] flex items-center justify-center shadow-2xl">
          <span class="text-white text-3xl font-black tracking-tighter">Y</span>
        </div>
        <div>
          <h2 class="text-3xl lg:text-4xl font-black tracking-[-1px]">
            YOUCO<span class="text-[var(--accent)]">'</span>DONE
          </h2>
          <p class="text-[var(--accent)] text-xs lg:text-sm font-medium tracking-[5px] uppercase mt-1.5 opacity-90">
            Gastronomie
          </p>
        </div>
      </div>

      <!-- Titre & sous-titre -->
      <div class="space-y-4">
        <h3 class="text-3xl lg:text-4xl font-semibold tracking-tight">
          Bienvenue
        </h3>
        <p class="text-gray-400 text-lg leading-relaxed">
          Connectez-vous pour réserver votre prochaine table d’exception ou gérer votre restaurant.
        </p>
      </div>

      <!-- Avantages courts & percutants -->
      <div class="grid grid-cols-3 gap-6 py-4">
        <div class="text-center">
          <div class="text-2xl font-bold text-[var(--accent)]">24/7</div>
          <div class="text-xs text-gray-500 mt-1.5 uppercase tracking-wider">Réservations</div>
        </div>
        <div class="text-center">
          <div class="text-2xl font-bold text-[var(--accent)]">+380</div>
          <div class="text-xs text-gray-500 mt-1.5 uppercase tracking-wider">Tables</div>
        </div>
        <div class="text-center">
          <div class="text-2xl font-bold text-[var(--accent)]">✓</div>
          <div class="text-xs text-gray-500 mt-1.5 uppercase tracking-wider">Sécurisé</div>
        </div>
      </div>

      <!-- Boutons d’action -->
      <div class="space-y-5 pt-8">

        @if (Route::has('login'))
          @auth

            @role('restaurateur')
              <a href="{{ route('restaurateur.dashboard') }}"
                 class="btn-primary block w-full py-5 rounded-2xl text-center text-sm font-black uppercase tracking-[2px] shadow-xl">
                Accéder au Dashboard
              </a>
            @endrole

            @role('client')
              <a href="{{ route('home') }}"
                 class="btn-primary block w-full py-5 rounded-2xl text-center text-sm font-black uppercase tracking-[2px] shadow-xl">
                Découvrir les restaurants
              </a>
            @endrole

            @role('admin')
              <a href="{{ route('admin.restaurants') }}"
                 class="btn-primary block w-full py-5 rounded-2xl text-center text-sm font-black uppercase tracking-[2px] shadow-xl">
                Administration
              </a>
            @endrole

          @else

            <a href="{{ route('login') }}"
               class="btn-primary block w-full py-5 rounded-2xl text-center text-sm font-black uppercase tracking-[2px] shadow-xl">
              Se connecter
            </a>

            @if (Route::has('register'))
              <a href="{{ route('register') }}"
                 class="btn-outline block w-full py-5 rounded-2xl text-center text-sm font-black uppercase tracking-[2px]">
                Créer un compte
              </a>
            @endif

          @endauth
        @endif

        <div class="text-center pt-4">
          
        </div>

      </div>

      <!-- Footer ultra discret -->
      <div class="pt-16 text-center">
        <p class="text-xs text-gray-700 font-medium tracking-widest uppercase">
          © 2025 Youco'Done
        </p>
      </div>

    </div>
  </div>

</body>
</html>