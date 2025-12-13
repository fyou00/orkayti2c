<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kopi Paste')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-amber-800">
                    <i class="fas fa-coffee"></i> Kopi Paste
                </a>
                
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 transition">Beranda</a>
                    <a href="{{ route('menu.public') }}" class="text-gray-700 hover:text-amber-600 transition">Menu</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-amber-600 transition">Tentang</a>
                </div>

                <div class="flex gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700 transition">
                                Dashboard Admin
                            </a>
                        @elseif(auth()->user()->isCashier())
                            <a href="{{ route('cashier.dashboard') }}" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                                Dashboard Kasir
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700 transition">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-amber-600">Beranda</a>
                <a href="{{ route('menu.public') }}" class="block py-2 text-gray-700 hover:text-amber-600">Menu</a>
                <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-amber-600">Tentang</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4"><i class="fas fa-coffee"></i> Kopi Paste</h3>
                    <p class="text-gray-400">Tempat terbaik untuk menikmati kopi dan makanan lezat dengan suasana yang nyaman.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <p class="text-gray-400"><i class="fas fa-map-marker-alt"></i> Jl. Kopi No. 123, Medan</p>
                    <p class="text-gray-400"><i class="fas fa-phone"></i> 0812-3456-7890</p>
                    <p class="text-gray-400"><i class="fas fa-envelope"></i> info@kopipaste.com</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Jam Buka</h4>
                    <p class="text-gray-400">Senin - Jumat: 08:00 - 22:00</p>
                    <p class="text-gray-400">Sabtu - Minggu: 09:00 - 23:00</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Kopi Paste. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>
</body>
</html>