{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kopi Paste - We\'ve got your morning covered')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .font-script { font-family: 'Dancing Script', cursive; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Poppins', sans-serif; }
        .font-google-sans { font-family: 'Google Sans', sans-serif; }
        .text-brown { color: #6B4423; }
        .bg-cream { background: #FDF8F3; }
        .bg-brown { background: #6B4423; }
        .bg-coffee { background: rgb(255, 115, 0); }
        
        .btn-gold {
            background: #E8B86D;
            color: #3D2817;
            transition: all 0.3s;
        }
        
        .btn-gold:hover {
            background: #D4A855;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(232, 184, 109, 0.3);
        }
        
        .card-hover {
            transition: all 0.3s;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans">
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="font-script text-4xl text-white">Kopi Paste</a>
                
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-white hover:text-yellow-300 transition {{ request()->routeIs('home') ? 'text-yellow-300 font-bold' : '' }}">Home</a>
                    <a href="{{ route('menu') }}" class="text-white hover:text-yellow-300 transition {{ request()->routeIs('menu') ? 'text-yellow-300 font-bold' : '' }}">Menu</a>
                    <a href="{{ route('about') }}" class="text-white hover:text-yellow-300 transition {{ request()->routeIs('about') ? 'text-yellow-300 font-bold' : '' }}">About Us</a>
                    <a href="{{ route('contact') }}#contact" class="text-white hover:text-yellow-300 transition">Contact Us</a>
                </div>
                
                <!-- Spacer -->
                <div class="hidden md:flex space-x-4">
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-white" onclick="toggleMobile()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-brown">
            <div class="px-6 py-4 space-y-4">
                <a href="{{ route('home') }}" class="block text-white hover:text-yellow-300">Home</a>
                <a href="{{ route('menu') }}" class="block text-white hover:text-yellow-300">Menu</a>
                <a href="{{ route('about') }}" class="block text-white hover:text-yellow-300">About Us</a>
                <a href="{{ route('contact') }}#contact" class="block text-white hover:text-yellow-300">Contact Us</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white py-16 bg-brown bg-cover bg-center" style="background-image: url('/images/fotter_image.png');">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div>
                    <h3 class="font-script text-4xl mb-4">Kopi Paste</h3>
                    <p class="text-gray-300 leading-relaxed mb-6">
                        Your perfect morning starts here. We serve the finest coffee with love and passion.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-white text-brown rounded-full flex items-center justify-center hover:bg-yellow-300 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white text-brown rounded-full flex items-center justify-center hover:bg-yellow-300 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white text-brown rounded-full flex items-center justify-center hover:bg-yellow-300 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white text-brown rounded-full flex items-center justify-center hover:bg-yellow-300 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                <!-- About -->
                <div>
                    <h4 class="font-serif text-2xl font-bold mb-6">About</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('menu') }}" class="text-gray-300 hover:text-yellow-300 transition">Menu</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-yellow-300 transition">About Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-yellow-300 transition">News & Blogs</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-yellow-300 transition">Help & Supports</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-serif text-2xl font-bold mb-6">Company</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-yellow-300 transition">How we work</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-yellow-300 transition">Terms of service</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-yellow-300 transition">Pricing</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-yellow-300 transition">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-serif text-2xl font-bold mb-6">Contact Us</h4>
                    <ul class="space-y-3 text-gray-300">
                        <li><i class="fas fa-map-marker-alt mr-2 text-yellow-300"></i> Jl. Kopi No. 123, Medan</li>
                        <li><i class="fas fa-phone mr-2 text-yellow-300"></i> 0812-3456-7890</li>
                        <li><i class="fas fa-envelope mr-2 text-yellow-300"></i> info@kopipaste.com</li>
                        <li><i class="fas fa-clock mr-2 text-yellow-300"></i> 08:00 - 22:00</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 600) {
                navbar.classList.add('bg-brown', 'shadow-lg');
            } else {
                navbar.classList.remove('bg-brown', 'shadow-lg');
            }
        });

        // Mobile menu toggle
        function toggleMobile() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    document.getElementById('mobileMenu').classList.add('hidden');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>