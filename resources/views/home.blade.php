@extends('layouts.app')

@section('title', 'Kopi Paste - Tempat Terbaik untuk Kopi')

@section('content')
<!-- Hero Section -->
<section class="relative bg-linear-to-r from-amber-600 to-orange-600 text-white">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-32 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in">Selamat Datang di Kopi Paste</h1>
        <p class="text-xl md:text-2xl mb-8 text-amber-100">Tempat terbaik untuk menikmati kopi dan makanan lezat</p>
        <div class="flex gap-4 justify-center">
            <a href="{{ route('menu.public') }}" class="bg-white text-amber-700 px-8 py-4 rounded-lg text-lg font-bold hover:bg-amber-50 transition transform hover:scale-105">
                <i class="fas fa-utensils"></i> Lihat Menu
            </a>
            <a href="{{ route('about') }}" class="bg-amber-800 text-white px-8 py-4 rounded-lg text-lg font-bold hover:bg-amber-900 transition transform hover:scale-105">
                <i class="fas fa-info-circle"></i> Tentang Kami
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Kenapa Memilih Kami?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-lg bg-amber-50 hover:bg-amber-100 transition transform hover:scale-105">
                <div class="bg-amber-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-coffee text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Kopi Berkualitas</h3>
                <p class="text-gray-600">Menggunakan biji kopi pilihan dengan cita rasa terbaik</p>
            </div>
            
            <div class="text-center p-8 rounded-lg bg-orange-50 hover:bg-orange-100 transition transform hover:scale-105">
                <div class="bg-orange-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-home text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Suasana Nyaman</h3>
                <p class="text-gray-600">Tempat yang cozy untuk bersantai dan bekerja</p>
            </div>
            
            <div class="text-center p-8 rounded-lg bg-amber-50 hover:bg-amber-100 transition transform hover:scale-105">
                <div class="bg-amber-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Pelayanan Ramah</h3>
                <p class="text-gray-600">Tim yang siap melayani dengan senyuman</p>
            </div>
        </div>
    </div>
</section>

<!-- Menu Highlight -->
@if(isset($featuredMenus) && $featuredMenus->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">Menu Populer</h2>
        <p class="text-center text-gray-600 mb-16">Cicipi menu favorit pelanggan kami</p>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($featuredMenus as $menu)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                @if($menu->foto)
                    <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-linear-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                        <i class="fas fa-utensils text-6xl text-white"></i>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">{{ $menu->nama }}</h3>
                    <p class="text-gray-600 mb-3"><i class="fas fa-tag"></i> {{ $menu->kategori }}</p>
                    <p class="text-2xl font-bold text-amber-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('menu.public') }}" class="bg-amber-600 text-white px-8 py-4 rounded-lg text-lg font-bold hover:bg-amber-700 transition inline-block">
                Lihat Semua Menu <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-20 bg-linear-to-r from-amber-600 to-orange-600 text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">Siap Menikmati Kopi Terbaik?</h2>
        <p class="text-xl mb-8 text-amber-100">Kunjungi kami sekarang dan rasakan pengalaman kopi yang tak terlupakan</p>
        <div class="flex gap-4 justify-center">
            <a href="{{ route('menu.public') }}" class="bg-white text-amber-700 px-8 py-4 rounded-lg text-lg font-bold hover:bg-amber-50 transition">
                Pesan Sekarang
            </a>
            <a href="{{ route('about') }}" class="bg-amber-800 text-white px-8 py-4 rounded-lg text-lg font-bold hover:bg-amber-900 transition">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection