<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookMyTable | Premium Restaurant Reservations</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body { font-family: 'Inter', sans-serif; }

        .hero-gradient {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)),
                url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1770&q=80');
            background-size: cover;
            background-position: center;
        }
        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #059669; }
    </style>
</head>

<body x-data="{ mobileMenuOpen: false }" class="antialiased text-gray-800">

    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center cursor-pointer">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-emerald-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-utensils text-white text-lg"></i>
                            </div>
                            <span class="text-2xl font-bold text-gray-800">BookMyTable</span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-emerald-600 font-semibold transition-colors duration-200">
                        Home
                    </a>

                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors">
                            Dashboard
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-2.5 rounded-2xl font-medium transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-2xl font-medium transition-colors duration-200 shadow-md">
                            Register
                        </a>
                    @endauth
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            <div x-show="mobileMenuOpen" class="md:hidden border-t border-gray-100 py-4">
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}" class="text-emerald-600 font-semibold text-left py-2">Home</a>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 font-medium w-full text-left">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 font-medium">Log in</a>
                        <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-6 py-2.5 rounded-2xl font-medium w-fit">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <section class="hero-gradient rounded-2xl shadow-2xl mb-12 p-8 md:p-12 text-white relative overflow-hidden">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Find & Book the Perfect Table</h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">Discover premium dining experiences with instant reservations</p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl p-6 mt-8 max-w-4xl">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">City</label>
                        <div class="relative">
                            <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-700" placeholder="Where to?">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Cuisine</label>
                        <div class="relative">
                            <i class="fas fa-utensils absolute left-3 top-3 text-gray-400"></i>
                            <select class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 appearance-none text-gray-700 bg-white">
                                <option>Any cuisine</option>
                                <option>Italian</option>
                                <option>French</option>
                                <option>Japanese</option>
                                <option>Moroccan</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Date & Time</label>
                        <div class="relative">
                            <i class="far fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
                            <input type="datetime-local" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-700">
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-3 rounded-2xl shadow-lg transition-colors duration-200">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Featured Restaurants</h2>
                <button class="text-emerald-600 font-medium hover:text-emerald-700">
                    View all <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer group">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1770&q=80" alt="Restaurant" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                            <span class="font-bold text-gray-800">4.8</span>
                            <span class="text-gray-500 text-sm ml-1">(124)</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold text-gray-800">La Bella Vista</h3>
                            <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-3 py-1 rounded-full">Italian</span>
                        </div>
                        <p class="text-gray-600 mt-2 line-clamp-2">Fine dining with panoramic city views and authentic Italian cuisine.</p>
                        <div class="flex items-center mt-4 text-gray-500">
                            <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                            <span>Downtown • <span class="text-emerald-600 font-bold">$$$</span></span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer group">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1554679665-f5537f187268?ixlib=rb-4.0.3&auto=format&fit=crop&w=1770&q=80" alt="Restaurant" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                            <span class="font-bold text-gray-800">4.9</span>
                            <span class="text-gray-500 text-sm ml-1">(87)</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold text-gray-800">Sakura Garden</h3>
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Japanese</span>
                        </div>
                        <p class="text-gray-600 mt-2 line-clamp-2">Authentic Japanese omakase experience with seasonal ingredients.</p>
                        <div class="flex items-center mt-4 text-gray-500">
                            <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                            <span>West End • <span class="text-emerald-600 font-bold">$$$$</span></span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer group">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1771&q=80" alt="Restaurant" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                            <span class="font-bold text-gray-800">4.7</span>
                            <span class="text-gray-500 text-sm ml-1">(203)</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold text-gray-800">Le Petit Bistro</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">French</span>
                        </div>
                        <p class="text-gray-600 mt-2 line-clamp-2">Charming Parisian bistro with classic French cuisine and wine selection.</p>
                        <div class="flex items-center mt-4 text-gray-500">
                            <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                            <span>Historic District • <span class="text-emerald-600 font-bold">$$</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-10 h-10 bg-emerald-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-utensils text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold">BookMyTable</span>
                    </div>
                    <p class="text-gray-400">Discover and book the finest dining experiences with instant confirmations.</p>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-6">Company</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-6">Support</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-6">Stay Connected</h4>
                    <div class="flex mb-4">
                        <input type="email" placeholder="Your email" class="flex-grow px-4 py-3 rounded-l-2xl focus:outline-none text-gray-800">
                        <button class="bg-emerald-600 hover:bg-emerald-700 px-5 rounded-r-2xl transition"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; 2026 BookMyTable. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>