{{-- resources/views/cashier/transaction/index.blade.php --}}
@extends('layouts.cashier')

@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')
<div class="mb-6">
    <form action="{{ route('cashier.transaction.index') }}" method="GET" class="flex gap-3 flex-wrap">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-4 py-2">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-4 py-2">
        <select name="metode_pembayaran" class="border rounded px-4 py-2">
            <option value="">Semua Metode</option>
            <option value="Tunai" {{ request('metode_pembayaran') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
            <option value="Transfer" {{ request('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
            <option value="QRIS" {{ request('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
            <option value="Kartu Debit/Kredit" {{ request('metode_pembayaran') == 'Kartu Debit/Kredit' ? 'selected' : '' }}>Kartu</option>
        </select>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pelanggan..." class="border rounded px-4 py-2 w-64">
        <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700">
            <i class="fas fa-search"></i> Cari
        </button>
        <a href="{{ route('cashier.transaction.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
            Reset
        </a>
    </form>
</div>

<div class="grid md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm mb-1">Total Transaksi</p>
        <p class="text-3xl font-bold text-gray-800">{{ $totalTransaksi }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm mb-1">Total Pendapatan</p>
        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm mb-1">Hari Ini</p>
        <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($totalHariIni, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm mb-1">Bulan Ini</p>
        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($totalBulanIni, 0, ',', '.') }}</p>
    </div>
</div>

@if($paymentMethodStats->count() > 0)
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-xl font-bold mb-4">Metode Pembayaran Hari Ini</h3>
    <div class="grid md:grid-cols-4 gap-4">
        @foreach($paymentMethodStats as $stat)
        <div class="text-center p-4 bg-gray-50 rounded-lg">
            <p class="text-gray-600">{{ $stat->metode_pembayaran }}</p>
            <p class="text-2xl font-bold text-orange-600">{{ $stat->count }}</p>
            <p class="text-sm text-gray-600">Rp {{ number_format($stat->total, 0, ',', '.') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left">Waktu</th>
                <th class="px-6 py-3 text-left">Pelanggan</th>
                <th class="px-6 py-3 text-left">Meja</th>
                <th class="px-6 py-3 text-left">Item</th>
                <th class="px-6 py-3 text-left">Metode</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm">{{ $transaction->created_at->format('H:i, d/m/Y') }}</td>
                <td class="px-6 py-4 font-semibold">{{ $transaction->order->nama_pelanggan }}</td>
                <td class="px-6 py-4">
                    @if($transaction->order->table)
                        Meja {{ $transaction->order->table->nomor }}
                    @else
                        <span class="text-gray-500">Take Away</span>
                    @endif
                </td>
                <td class="px-6 py-4">{{ $transaction->order->items->count() }} item</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm">
                        {{ $transaction->metode_pembayaran }}
                    </span>
                </td>
                <td class="px-6 py-4 font-bold text-green-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('cashier.transaction.show', $transaction) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-receipt text-6xl mb-4"></i>
                    <p class="text-xl">Tidak ada transaksi</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $transactions->links() }}
</div>
@endsection
