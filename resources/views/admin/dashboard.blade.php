{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Menu</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalMenus }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    <span class="text-green-600">{{ $menuTersedia }}</span> tersedia | 
                    <span class="text-red-600">{{ $menuTidakTersedia }}</span> habis
                </p>
            </div>
            <div class="bg-amber-100 p-4 rounded-lg">
                <i class="fas fa-utensils text-3xl text-amber-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Meja</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalTables }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    <span class="text-green-600">{{ $tableTersedia }}</span> tersedia | 
                    <span class="text-orange-600">{{ $tableTerisi }}</span> terisi
                </p>
            </div>
            <div class="bg-blue-100 p-4 rounded-lg">
                <i class="fas fa-table text-3xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Pesanan Aktif</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalPesananAktif }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    <span class="text-yellow-600">{{ $pesananMenunggu }}</span> menunggu | 
                    <span class="text-blue-600">{{ $pesananDiproses }}</span> diproses
                </p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg">
                <i class="fas fa-shopping-cart text-3xl text-green-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Transaksi Hari Ini</p>
                <p class="text-3xl font-bold text-gray-800">{{ $transaksiHariIni }}</p>
                <p class="text-sm font-bold text-green-600 mt-1">
                    Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}
                </p>
            </div>
            <div class="bg-purple-100 p-4 rounded-lg">
                <i class="fas fa-money-bill-wave text-3xl text-purple-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Revenue This Month -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-xl font-bold mb-4">Pendapatan Bulan Ini</h3>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-600">Total Transaksi</p>
            <p class="text-3xl font-bold text-gray-800">{{ $transaksiBulanIni }}</p>
        </div>
        <div class="text-right">
            <p class="text-gray-600">Total Pendapatan</p>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold">Pesanan Terbaru</h3>
        </div>
        <div class="p-6">
            @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                    <div class="border-l-4 border-amber-500 pl-4 py-2">
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
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-bold
                                @if($order->status === 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($order->status === 'diproses') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $order->items->count() }} item</p>
                        <p class="font-bold text-amber-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Tidak ada pesanan aktif</p>
            @endif
        </div>
    </div>

    <!-- Top Selling Menus -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold">Menu Terlaris Bulan Ini</h3>
        </div>
        <div class="p-6">
            @if($topMenus->count() > 0)
                <div class="space-y-4">
                    @foreach($topMenus as $index => $menu)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                                <span class="font-bold text-amber-600">#{{ $index + 1 }}</span>
                            </div>
                            <div>
                                <p class="font-bold">{{ $menu->nama }}</p>
                                <p class="text-sm text-gray-600">{{ $menu->total_qty }} terjual</p>
                            </div>
                        </div>
                        <p class="font-bold text-green-600">
                            Rp {{ number_format($menu->total_sales, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada data penjualan</p>
            @endif
        </div>
    </div>
</div>
@endsection