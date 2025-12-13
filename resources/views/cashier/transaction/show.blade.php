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
