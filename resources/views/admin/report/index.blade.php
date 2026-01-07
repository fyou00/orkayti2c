@extends('layouts.admin')

@section('title', 'Laporan Penjualan - Admin')
@section('page-title', 'Laporan Penjualan')

@section('content')
<div class="space-y-6">
    <!-- Filter Section -->
    <div class="bg-white p-6 rounded-lg shadow">
        <form method="GET" action="{{ route('admin.report.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('admin.report.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-refresh"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Export Buttons -->
    <div class="flex gap-2 justify-end">
        <a href="{{ route('admin.report.print', request()->query()) }}" target="_blank" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-print"></i> Print
        </a>
        <a href="{{ route('admin.report.export', request()->query()) }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-file-excel"></i> Export CSV
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-receipt text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Transaksi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalTransaksi) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-money-bill-wave text-green-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalPendapatan) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fas fa-shopping-cart text-purple-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Pesanan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalPesanan) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 bg-amber-100 rounded-full">
                    <i class="fas fa-chart-line text-amber-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Rata-rata/Transaksi</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($rataRataTransaksi) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales by Category -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-chart-pie"></i> Penjualan per Kategori
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Qty</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($salesByCategory as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $category->kategori }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($category->total_qty) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($category->total_transaksi) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($category->total_pendapatan) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-amber-600 h-2 rounded-full" style="width: {{ $totalPendapatan > 0 ? ($category->total_pendapatan / $totalPendapatan * 100) : 0 }}%"></div>
                                </div>
                                <span class="text-sm">{{ $totalPendapatan > 0 ? number_format($category->total_pendapatan / $totalPendapatan * 100, 1) : 0 }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Top Selling Menu -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-star"></i> Menu Terlaris (Top 10)
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Menu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Terjual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($topMenus as $index => $menu)
                    <tr class="{{ $index < 3 ? 'bg-amber-50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($index == 0)
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 text-white rounded-full font-bold">1</span>
                            @elseif($index == 1)
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-400 text-white rounded-full font-bold">2</span>
                            @elseif($index == 2)
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-600 text-white rounded-full font-bold">3</span>
                            @else
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-600 rounded-full">{{ $index + 1 }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $menu->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">{{ $menu->kategori }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($menu->harga) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-600">{{ number_format($menu->total_qty) }} item</td>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-600">Rp {{ number_format($menu->total_pendapatan) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-credit-card"></i> Metode Pembayaran
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($paymentMethods as $method)
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-gray-500">{{ ucfirst($method->metode_pembayaran) }}</span>
                    <i class="fas fa-{{ $method->metode_pembayaran == 'cash' ? 'money-bill' : 'qrcode' }} text-amber-600"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($method->total_transaksi) }}</p>
                <p class="text-sm text-gray-600">Rp {{ number_format($method->total_pendapatan) }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Daily Sales Chart -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-chart-bar"></i> Grafik Penjualan Harian
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rata-rata</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($dailySales as $sale)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sale->total_transaksi) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-600">Rp {{ number_format($sale->total_pendapatan) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($sale->total_transaksi > 0 ? $sale->total_pendapatan / $sale->total_transaksi : 0) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 font-bold">
                    <tr>
                        <td class="px-6 py-4">TOTAL</td>
                        <td class="px-6 py-4">{{ number_format($totalTransaksi) }}</td>
                        <td class="px-6 py-4 text-green-600">Rp {{ number_format($totalPendapatan) }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($rataRataTransaksi) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Hourly Sales Pattern -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-clock"></i> Pola Penjualan per Jam
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @for($hour = 0; $hour < 24; $hour++)
                @php
                    $hourData = $hourlySales->firstWhere('hour', $hour);
                    $transaksi = $hourData ? $hourData->total_transaksi : 0;
                    $pendapatan = $hourData ? $hourData->total_pendapatan : 0;
                    $maxTransaksi = $hourlySales->max('total_transaksi') ?: 1;
                    $heightPercent = ($transaksi / $maxTransaksi) * 100;
                @endphp
                <div class="text-center">
                    <div class="h-32 flex items-end justify-center mb-2">
                        <div class="w-full bg-amber-500 rounded-t-lg" style="height: {{ $heightPercent }}%">
                            @if($transaksi > 0)
                                <span class="text-xs text-white font-bold">{{ $transaksi }}</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 font-semibold">{{ sprintf('%02d:00', $hour) }}</p>
                    @if($pendapatan > 0)
                        <p class="text-xs text-gray-500">Rp {{ number_format($pendapatan / 1000) }}k</p>
                    @endif
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
