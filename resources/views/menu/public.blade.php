@extends('layouts.app')

@section('title', 'Menu - Kopi Paste')

@push('styles')
<style>
    .hero-menu {
        background: linear-gradient(135deg, #6B4423 0%, #3D2817 100%);
        position: relative;
        overflow: hidden;
    }
    
    .hero-menu::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('/images/coffee_hero.png');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
    }
    
    .menu-card {
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(107, 68, 35, 0.2);
    }
    
    .menu-card img {
        transition: transform 0.4s ease;
    }
    
    .menu-card:hover img {
        transform: scale(1.1);
    }
    
    .badge-unavailable {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(220, 38, 38, 0.95);
        color: white;
        padding: 6px 12px;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 12px;
        z-index: 10;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    }
    
    .category-nav {
        position: sticky;
        top: 80px;
        background: white;
        z-index: 40;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .category-link {
        transition: all 0.3s;
        position: relative;
    }
    
    .category-link.active {
        color: #E8B86D;
        font-weight: 700;
    }
    
    .category-link.active::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        right: 0;
        height: 3px;
        background: #E8B86D;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-menu pt-32 pb-20">
        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <h1 class="font-serif text-6xl md:text-7xl text-white font-bold mb-6">Our Menu</h1>
            <p class="text-white text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                Discover the finest selection of coffee and delights. Every cup tells a story, every bite brings joy.
            </p>
            <div class="flex justify-center items-center gap-4 text-white">
                <i class="fas fa-coffee text-3xl"></i>
                <span class="text-lg">{{ $menusByCategory->sum(function($items) { return $items->count(); }) }} Items Available</span>
            </div>
        </div>
    </section>

    <!-- Menu Content -->
    <section class="py-16 bg-cream">
        <div class="max-w-7xl mx-auto px-6">
            
            @if($menusByCategory->count() > 0)
                @foreach($menusByCategory as $kategori => $menus)
                <div id="{{ Str::slug($kategori) }}" class="mb-20 scroll-mt-32">
                    <!-- Category Header -->
                    <div class="mb-12">
                        <div class="flex items-center mb-4">
                            <div class="h-1 w-16 bg-gradient-to-r from-brown to-yellow-600 rounded"></div>
                            <h2 class="font-serif text-5xl text-brown font-bold ml-6">{{ $kategori }}</h2>
                        </div>
                        <p class="text-gray-600 text-lg ml-22">Explore our selection of {{ strtolower($kategori) }}</p>
                    </div>
                    
                    <!-- Menu Grid -->
                    <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach($menus as $menu)
                        <div class="menu-card bg-white rounded-2xl overflow-hidden shadow-lg">
                            <!-- Image Container - Fixed Height -->
                            <div class="relative h-56 overflow-hidden bg-gray-200 flex-shrink-0">
                                @if($menu->foto)
                                    <img src="{{ Storage::url($menu->foto) }}" 
                                         alt="{{ $menu->nama }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-200 to-orange-300">
                                        <i class="fas fa-coffee text-6xl text-brown opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Badge Unavailable -->
                                @if($menu->status === 'tidak tersedia')
                                    <span class="badge-unavailable">
                                        <i class="fas fa-times-circle mr-1"></i> Sold Out
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Content Container - Flex Grow -->
                            <div class="p-6 flex flex-col flex-grow">
                                <!-- Menu Info - Flex Grow to Push Button Down -->
                                <div class="flex-grow">
                                    <!-- Title & Category -->
                                    <div class="mb-3">
                                        <h3 class="font-serif text-xl text-brown font-bold mb-1 line-clamp-2">{{ $menu->nama }}</h3>
                                        <p class="text-gray-500 text-sm">
                                            <i class="fas fa-tag mr-1"></i> {{ $menu->kategori }}
                                        </p>
                                    </div>
                                    
                                    <!-- Price & Status -->
                                    <div class="mb-4">
                                        <div class="font-serif text-2xl text-brown font-bold mb-2">
                                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                        </div>
                                        
                                        @if($menu->status === 'tersedia')
                                            <span class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fas fa-check-circle mr-1"></i> Available
                                            </span>
                                        @else
                                            <span class="inline-flex items-center bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fas fa-times-circle mr-1"></i> Not Available
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Action Button - Always at Bottom -->
                                <div class="mt-auto pt-2">
                                    @if($menu->status === 'tersedia')
                                        <button onclick="showOrderInfo()" class="w-full btn-gold py-3 rounded-full font-semibold text-base">
                                            <i class="fas fa-shopping-cart mr-2"></i> Order Now
                                        </button>
                                    @else
                                        <button disabled class="w-full bg-gray-200 text-gray-500 py-3 rounded-full font-semibold text-base cursor-not-allowed">
                                            <i class="fas fa-ban mr-2"></i> Not Available
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <i class="fas fa-coffee text-8xl text-gray-300 mb-6"></i>
                    <h3 class="font-serif text-3xl text-gray-600 mb-4">No Menu Available</h3>
                    <p class="text-gray-500 text-lg">We're updating our menu. Please check back later!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- How to Order Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-serif text-5xl text-brown font-bold mb-4">How to Order</h2>
                <p class="text-gray-600 text-xl">Simple steps to get your perfect coffee</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-brown to-yellow-700 rounded-full flex items-center justify-center text-white text-3xl font-bold">1</div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">Browse Menu</h3>
                    <p class="text-gray-600">Choose from our wide selection of coffee and food</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-brown to-yellow-700 rounded-full flex items-center justify-center text-white text-3xl font-bold">2</div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">Visit Our Cafe</h3>
                    <p class="text-gray-600">Come to our location and place your order</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-brown to-yellow-700 rounded-full flex items-center justify-center text-white text-3xl font-bold">3</div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">Order at Counter</h3>
                    <p class="text-gray-600">Our friendly cashier will assist you</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-brown to-yellow-700 rounded-full flex items-center justify-center text-white text-3xl font-bold">4</div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">Enjoy!</h3>
                    <p class="text-gray-600">Sit back, relax, and enjoy your coffee</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <div class="inline-block bg-yellow-50 border-2 border-yellow-300 rounded-2xl p-8">
                    <i class="fas fa-info-circle text-4xl text-yellow-600 mb-4"></i>
                    <p class="text-gray-700 text-lg font-semibold mb-2">📍 Visit Us</p>
                    <p class="text-gray-600">Jl. Kopi No. 123, Medan | Open 08:00 - 22:00</p>
                    <p class="text-gray-600 mt-2">☎️ 0812-3456-7890</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-brown to-yellow-800">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="font-serif text-5xl text-white font-bold mb-6">Ready to Order?</h2>
            <p class="text-white text-xl mb-8">Visit us today and experience the best coffee in town</p>
            <a href="{{ route('about') }}#contact" class="inline-block btn-gold px-12 py-4 rounded-full text-xl font-bold">
                Get Directions
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Smooth scroll for category links
    document.querySelectorAll('.category-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            // Remove active class from all links
            document.querySelectorAll('.category-link').forEach(l => l.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Scroll to target
            if (targetId === '#all') {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                const target = document.querySelector(targetId);
                if (target) {
                    const offset = 160;
                    const targetPosition = target.offsetTop - offset;
                    window.scrollTo({ top: targetPosition, behavior: 'smooth' });
                }
            }
        });
    });

    // Show order info modal
    function showOrderInfo() {
        alert('To order, please visit our cafe at:\n\nJl. Kopi No. 123, Medan\nOpen: 08:00 - 22:00\n\nOr call us at: 0812-3456-7890');
    }

    // Highlight active category on scroll
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('[id]');
        const scrollPosition = window.scrollY + 200;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                document.querySelectorAll('.category-link').forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    });
</script>
@endpush