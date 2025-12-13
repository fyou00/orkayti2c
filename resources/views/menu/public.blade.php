{{-- resources/views/menu/public.blade.php --}}
@extends('layouts.app')

@section('title', 'Menu - Kopi Paste')

@section('content')
<div class="bg-linear-to-r from-amber-600 to-orange-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">Menu Kami</h1>
        <p class="text-xl text-amber-100">Pilihan kopi dan makanan terbaik untuk Anda</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    @if(isset($menusByCategory) && $menusByCategory->count() > 0)
        @foreach($menusByCategory as $kategori => $menus)
        <div class="mb-16">
            <div class="flex items-center mb-8">
                <div class="bg-amber-600 w-2 h-10 mr-4"></div>
                <h2 class="text-4xl font-bold text-gray-800">{{ $kategori }}</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($menus as $menu)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                    @if($menu->foto)
                        <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama }}" class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                            <i class="fas fa-utensils text-6xl text-white"></i>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $menu->nama }}</h3>
                            @if($menu->status === 'tidak tersedia')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                                    <i class="fas fa-times-circle"></i> Habis
                                </span>
                            @endif
                        </div>
                        <p class="text-3xl font-bold text-amber-600 mb-4">
                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                        </p>
                        @if($menu->status === 'tersedia')
                            <div class="bg-green-50 text-green-700 px-4 py-2 rounded text-center">
                                <i class="fas fa-check-circle"></i> Tersedia
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @else
        <div class="text-center py-20">
            <i class="fas fa-coffee text-6xl text-gray-300 mb-4"></i>
            <p class="text-xl text-gray-500">Belum ada menu tersedia</p>
        </div>
    @endif
</div>

<!-- Info Section -->
<div class="bg-amber-50 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold mb-4 text-gray-800">
                <i class="fas fa-info-circle text-amber-600"></i> Cara Memesan
            </h3>
            <ol class="list-decimal list-inside space-y-3 text-gray-700">
                <li>Pilih menu yang Anda inginkan dari daftar di atas</li>
                <li>Datang ke kasir dan sebutkan pesanan Anda</li>
                <li>Kasir akan mencatat pesanan dan menghitung total pembayaran</li>
                <li>Lakukan pembayaran dan tunggu pesanan Anda siap</li>
            </ol>
            <div class="mt-6 p-4 bg-amber-50 rounded-lg">
                <p class="text-gray-700">
                    <i class="fas fa-clock text-amber-600"></i> 
                    <strong>Jam Operasional:</strong> Senin - Jumat (08:00 - 22:00) | Sabtu - Minggu (09:00 - 23:00)
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
