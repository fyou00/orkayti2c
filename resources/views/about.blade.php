{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', 'Tentang Kami - Kopi Paste')

@section('content')
<div class="bg-gradient-to-r from-amber-600 to-orange-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">Tentang Kopi Paste</h1>
        <p class="text-xl text-amber-100">Kenali lebih dekat dengan kami</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-16">
    <!-- About Story -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fas fa-coffee text-amber-600"></i> Cerita Kami
        </h2>
        <p class="text-lg text-gray-700 mb-4 leading-relaxed">
            Kopi Paste adalah cafe yang didirikan dengan misi untuk menyajikan kopi berkualitas tinggi 
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
