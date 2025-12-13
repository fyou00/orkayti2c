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


{{-- resources/views/cashier/transaction/show.blade.php --}}
@extends('layouts.cashier')

@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-6 pb-6 border-b">
            <h2 class="text-3xl font-bold mb-2">STRUK PEMBAYARAN</h2>
            <p class="text-gray-600">Kopi Paste</p>
            <p class="text-sm text-gray-500">Jl. Kopi No. 123, Medan</p>
            <p class="text-sm text-gray-500">Telp: 0812-3456-7890</p>
        </div>

        <div class="mb-6">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-gray-600">Nomor Transaksi</p>
                    <p class="font-bold">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tanggal</p>
                    <p class="font-bold">{{ $transaction->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Pelanggan</p>
                    <p class="font-bold">{{ $transaction->order->nama_pelanggan }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Meja</p>
                    <p class="font-bold">
                        @if($transaction->order->table)
                            Meja {{ $transaction->order->table->nomor }}
                        @else
                            Take Away
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-lg mb-3">Item Pesanan</h3>
            <table class="w-full">
                <thead class="border-b-2 border-gray-300">
                    <tr>
                        <th class="text-left py-2">Item</th>
                        <th class="text-center py-2">Qty</th>
                        <th class="text-right py-2">Harga</th>
                        <th class="text-right py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->order->items as $item)
                    <tr class="border-b">
                        <td class="py-3">{{ $item->menu->nama }}</td>
                        <td class="py-3 text-center">{{ $item->qty }}</td>
                        <td class="py-3 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="py-3 text-right font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t-2 border-gray-300 pt-4 mb-6">
            <div class="flex justify-between text-2xl font-bold mb-4">
                <span>TOTAL:</span>
                <span class="text-green-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Metode Pembayaran:</span>
                <span class="font-bold">{{ $transaction->metode_pembayaran }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Status:</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded font-bold">
                    {{ $transaction->status_pembayaran }}
                </span>
            </div>
        </div>

        <div class="text-center py-6 border-t">
            <p class="text-gray-600">Terima kasih atas kunjungan Anda!</p>
            <p class="text-sm text-gray-500 mt-2">Kasir: {{ auth()->user()->name }}</p>
        </div>

        <div class="flex gap-3 mt-6">
            <a href="{{ route('cashier.transaction.index') }}" class="flex-1 bg-gray-400 text-white px-6 py-3 rounded-lg hover:bg-gray-500 text-center">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="flex-1 bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700">
                <i class="fas fa-print"></i> Cetak Struk
            </button>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .max-w-4xl, .max-w-4xl * {
        visibility: visible;
    }
    .max-w-4xl {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    button, .flex.gap-3 {
        display: none !important;
    }
}
</style>
@endsection


{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kopi Paste</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-amber-100 to-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="bg-amber-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-coffee text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-amber-800 mb-2">Kopi Paste</h1>
            <p class="text-gray-600">Silakan login untuk melanjutkan</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-lg shadow-xl p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('email') border-red-500 @enderror" 
                        required 
                        autofocus 
                        placeholder="masukkan email"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('password') border-red-500 @enderror" 
                        required 
                        placeholder="masukkan password"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input 
                        id="remember" 
                        type="checkbox" 
                        name="remember" 
                        class="w-4 h-4 text-amber-600 border-gray-300 rounded focus:ring-amber-500"
                    >
                    <label for="remember" class="ml-2 text-gray-700">
                        Ingat Saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition font-bold text-lg"
                >
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <!-- Back to Home -->
                <div class="text-center mt-6">
                    <a href="{{ route('home') }}" class="text-amber-600 hover:text-amber-700">
                        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>

        <!-- Demo Accounts Info -->
        <div class="mt-6 bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600 mb-2 font-bold">Akun Demo:</p>
            <div class="text-sm text-gray-600">
                <p><strong>Admin:</strong> admin@kopipaste.com | password</p>
                <p><strong>Kasir:</strong> kasir@kopipaste.com | password</p>
            </div>
        </div>
    </div>
</body>
</html>