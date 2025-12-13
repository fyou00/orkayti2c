{{-- resources/views/cashier/dashboard.blade.php --}}
@extends('layouts.cashier')

@section('title', 'Kasir Dashboard')
@section('page-title', 'Dashboard Kasir')

@section('content')
<!-- Statistics Cards -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Pesanan Menunggu</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $pesananMenunggu }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg">
                <i class="fas fa-clock text-3xl text-yellow-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Pesanan Diproses</p>
                <p class="text-3xl font-bold text-blue-600">{{ $pesananDiproses }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-lg">
                <i class="fas fa-shopping-cart text-3xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Transaksi Hari Ini</p>
                <p class="text-3xl font-bold text-green-600">{{ $transaksiHariIni }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg">
                <i class="fas fa-receipt text-3xl text-green-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Pendapatan Hari Ini</p>
                <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}</p>
            </div>
            <div class="bg-orange-100 p-4 rounded-lg">
                <i class="fas fa-money-bill-wave text-3xl text-orange-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-xl font-bold mb-4">Aksi Cepat</h3>
    <div class="grid md:grid-cols-3 gap-4">
        <a href="{{ route('cashier.order.create') }}" class="bg-orange-600 text-white p-6 rounded-lg hover:bg-orange-700 transition text-center">
            <i class="fas fa-plus-circle text-4xl mb-3"></i>
            <p class="text-xl font-bold">Buat Pesanan Baru</p>
        </a>
        <a href="{{ route('cashier.order.index') }}" class="bg-blue-600 text-white p-6 rounded-lg hover:bg-blue-700 transition text-center">
            <i class="fas fa-list text-4xl mb-3"></i>
            <p class="text-xl font-bold">Lihat Pesanan Aktif</p>
        </a>
        <a href="{{ route('cashier.transaction.index') }}" class="bg-green-600 text-white p-6 rounded-lg hover:bg-green-700 transition text-center">
            <i class="fas fa-history text-4xl mb-3"></i>
            <p class="text-xl font-bold">Riwayat Transaksi</p>
        </a>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-xl font-bold">Pesanan Aktif</h3>
            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-bold">
                {{ $totalPesananAktif }} Pesanan
            </span>
        </div>
        <div class="p-6 max-h-96 overflow-y-auto">
            @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                    <div class="border-l-4 pl-4 py-2
                        @if($order->status === 'menunggu') border-yellow-500
                        @else border-blue-500 @endif">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold">{{ $order->nama_pelanggan }}</p>
                                <p class="text-sm text-gray-600">
                                    @if($order->table)
                                        <i class="fas fa-table"></i> Meja {{ $order->table->nomor }}
                                    @else
                                        <i class="fas fa-shopping-bag"></i> Take Away
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('H:i') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-bold
                                @if($order->status === 'menunggu') bg-yellow-100 text-yellow-700
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $order->items->count() }} item</p>
                        <p class="font-bold text-orange-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <a href="{{ route('cashier.order.show', $order) }}" class="text-sm text-blue-600 hover:text-blue-800 mt-2 inline-block">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Tidak ada pesanan aktif</p>
            @endif
        </div>
    </div>

    <!-- Popular Menus Today & Table Status -->
    <div class="space-y-6">
        <!-- Popular Menus -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-xl font-bold">Menu Populer Hari Ini</h3>
            </div>
            <div class="p-6">
                @if($popularMenusToday->count() > 0)
                    <div class="space-y-3">
                        @foreach($popularMenusToday as $menu)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @if($menu->foto)
                                    <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama }}" class="w-12 h-12 object-cover rounded mr-3">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-utensils text-gray-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold">{{ $menu->nama }}</p>
                                    <p class="text-sm text-gray-600">{{ $menu->total_qty }} terjual</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-4">Belum ada penjualan hari ini</p>
                @endif
            </div>
        </div>

        <!-- Table Status -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Status Meja</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-green-50 p-4 rounded-lg text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $tableTersedia }}</p>
                    <p class="text-gray-600">Meja Tersedia</p>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg text-center">
                    <p class="text-3xl font-bold text-orange-600">{{ $tableTerisi }}</p>
                    <p class="text-gray-600">Meja Terisi</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
