@extends('layouts.app')

@section('title', 'Tentang Kami - ORKAY TI 2C')

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
        transform: translateY(-2px);
        box-shadow: 0 25px 50px rgba(107, 68, 35, 0.2);
    }
    
    .menu-card img {
        transition: transform 0.4s ease;
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
            <h1 class="font-sans text-6xl md:text-7xl text-white font-bold mb-6">Tentang Kami</h1>
            <p class="text-white text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                Discover the finest selection of coffee and delights. Every cup tells a story, every bite brings joy.
            </p>
        </div>
    </section>

<div class="max-w-4xl mx-auto px-4 py-16">
    <!-- About Story -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fas fa-coffee text-amber-600"></i> Cerita Kami
        </h2>
        <p class="text-lg text-gray-700 mb-4 leading-relaxed">
            ORKAY TI 2C adalah cafe yang didirikan dengan misi untuk menyajikan kopi berkualitas tinggi 
            dengan suasana yang nyaman dan pelayanan yang ramah. Kami percaya bahwa setiap cangkir kopi 
            memiliki cerita yang unik, dan kami ingin berbagi cerita tersebut dengan Anda.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed">
            Dengan menggunakan biji kopi pilihan terbaik dan teknik penyeduhan yang tepat, kami berkomitmen 
            untuk memberikan pengalaman kopi yang tak terlupakan bagi setiap pelanggan yang datang.
        </p>
    </div>

    <!-- Vision Mission -->
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold mb-4 text-amber-600">
                <i class="fas fa-eye"></i> Visi Kami
            </h3>
            <p class="text-gray-700 leading-relaxed">
                Menjadi cafe pilihan utama yang dikenal dengan kualitas kopi terbaik, 
                suasana nyaman, dan pelayanan yang memuaskan.
            </p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold mb-4 text-amber-600">
                <i class="fas fa-bullseye"></i> Misi Kami
            </h3>
            <p class="text-gray-700 leading-relaxed">
                Menyajikan kopi berkualitas tinggi dengan layanan terbaik, 
                menciptakan ruang yang nyaman, dan membangun komunitas pecinta kopi.
            </p>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fas fa-map-marker-alt text-amber-600"></i> Kontak & Lokasi
        </h2>
        
        <div class="space-y-4">
            <div class="flex items-start">
                <div class="bg-amber-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-map-marker-alt text-amber-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">Alamat</h4>
                    <p class="text-gray-700">Jl. Kopi No. 123, Medan, Sumatera Utara</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="bg-amber-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-phone text-amber-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">Telepon</h4>
                    <p class="text-gray-700">0812-3456-7890</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="bg-amber-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-envelope text-amber-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">Email</h4>
                    <p class="text-gray-700">info@kopipaste.com</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="bg-amber-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-clock text-amber-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">Jam Buka</h4>
                    <p class="text-gray-700">Senin - Jumat: 08:00 - 22:00</p>
                    <p class="text-gray-700">Sabtu - Minggu: 09:00 - 23:00</p>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-200">
            <h4 class="font-bold text-gray-800 mb-4">Ikuti Kami</h4>
            <div class="flex gap-4">
                <a href="#" class="bg-amber-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-amber-700 transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="bg-amber-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-amber-700 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="bg-amber-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-amber-700 transition">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="bg-amber-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-amber-700 transition">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
