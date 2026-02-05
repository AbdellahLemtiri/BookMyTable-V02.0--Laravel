<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Youco\'Done') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;900&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0A0A0A;
            color: white;
        }

        .profile-card {
            background: #111111;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .orange-glow:focus {
            border-color: #FF5F00 !important;
            box-shadow: 0 0 15px rgba(255, 95, 0, 0.1) !important;
        }

        .avatar-ring {
            border: 3px solid #FF5F00;
            padding: 4px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #050505;
            color: white;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .glass {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#0A0A0A] text-white">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-[#111111] border-b border-white/5">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>
    <div id="toast-container" class="fixed top-5 right-5 z-[100] flex flex-col gap-3 w-full max-w-[320px]">

        @if (session('success'))
            <div class="toast-item flex items-center p-4 bg-black text-white rounded-xl shadow-2xl animate-in-right">
                <div
                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-green-500 rounded-full text-[10px]">
                    <i class="fa-solid fa-check text-white"></i>
                </div>
                <div class="ml-3">
                    <p class="text-[11px] font-bold uppercase tracking-widest">{{ session('success') }}</p>
                    <p class="text-[9px] text-gray-400">Votre contenu est en ligne.</p>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-auto text-gray-500 hover:text-white">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div
                    class="toast-item flex items-center p-4 bg-white border border-red-100 shadow-xl rounded-xl animate-in-right">
                    <div
                        class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-red-500 rounded-full text-[10px]">
                        <i class="fa-solid fa-exclamation text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-red-600">Erreur de saisie</p>
                        <p class="text-[9px] text-gray-500">{{ $error }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-gray-300 hover:text-gray-600">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>
            @endforeach
        @endif
    </div>

    <style>
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }

            to {
                opacity: 0;
                transform: scale(0.9);
            }
        }

        .animate-in-right {
            animation: slideInRight 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .toast-exit {
            animation: fadeOut 0.3s ease forwards;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toasts = document.querySelectorAll('.toast-item');

            toasts.forEach((toast) => {
                setTimeout(() => {
                    toast.classList.add('toast-exit');
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 5000);
            });
        });
    </script>
</body>

</html>
