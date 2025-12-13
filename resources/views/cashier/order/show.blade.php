{{-- resources/views/cashier/order/show.blade.php --}}
@extends('layouts.cashier')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-3xl font-bold mb-2">{{ $order->nama_pelanggan }}</h2>
                <p class="text-gray-600">
                    <i class="fas fa-clock"></i> {{ $order->created_at->format('H:i, d F Y') }}
                </p>
                @if($order->table)
                    <p class="text-gray-600">
                        <i class="fas fa-table"></i> Meja {{ $order->table->nomor }} (Kapasitas {{ $order->table->kapasitas }} orang)
                    </p>
                @else
                    <p class="text-gray-600">
                        <i class="fas fa-shopping-bag"></i> Take Away
                    </p>
                @endif
            </div>
            
            <span class="px-4 py-2 rounded-full text-lg font-bold
                @if($order->status === 'menunggu') bg-yellow-100 text-yellow-700
                @elseif($order->status === 'diproses') bg-blue-100 text-blue-700
                @else bg-green-100 text-green-700 @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="border-t border-b py-6 mb-6">
            <h3 class="font-bold text-xl mb-4">Item Pesanan</h3>
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Menu</th>
                        <th class="text-center p-3">Qty</th>
                        <th class="text-right p-3">Harga</th>
                        <th class="text-right p-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr class="border-b">
                        <td class="p-3">
                            <div class="flex items-center">
                                @if($item->menu->foto)
                                    <img src="{{ Storage::url($item->menu->foto) }}" alt="{{ $item->menu->nama }}" class="w-12 h-12 object-cover rounded mr-3">
                                @endif
                                <span class="font-semibold">{{ $item->menu->nama }}</span>
                            </div>
                        </td>
                        <td class="p-3 text-center font-bold">{{ $item->qty }}</td>
                        <td class="p-3 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="p-3 text-right font-bold text-orange-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-100">
                    <tr>
                        <td colspan="3" class="p-3 text-right font-bold text-lg">Total:</td>
                        <td class="p-3 text-right font-bold text-2xl text-orange-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($order->transaction)
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <h4 class="font-bold text-green-800 mb-2">
                <i class="fas fa-check-circle"></i> Transaksi Selesai
            </h4>
            <p class="text-gray-700">
                <strong>Metode Pembayaran:</strong> {{ $order->transaction->metode_pembayaran }}
            </p>
            <p class="text-gray-700">
                <strong>Status:</strong> {{ $order->transaction->status_pembayaran }}
            </p>
            <p class="text-gray-700">
                <strong>Waktu:</strong> {{ $order->transaction->created_at->format('H:i, d F Y') }}
            </p>
        </div>
        @endif

        <div class="flex gap-3">
            <a href="{{ route('cashier.order.index') }}" class="bg-gray-400 text-white px-6 py-3 rounded-lg hover:bg-gray-500">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            
            @if($order->status === 'menunggu')
                <form action="{{ route('cashier.order.updateStatus', $order) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="diproses">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-play"></i> Proses Pesanan
                    </button>
                </form>
            @elseif($order->status === 'diproses')
                <button onclick="openPaymentModal()" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-check"></i> Selesaikan Pesanan
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-2xl font-bold mb-4">Pilih Metode Pembayaran</h3>
        <form action="{{ route('cashier.order.updateStatus', $order) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="selesai">
            
            <div class="space-y-3 mb-6">
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="metode_pembayaran" value="Tunai" class="mr-3" required checked>
                    <i class="fas fa-money-bill-wave text-green-600 text-2xl mr-3"></i>
                    <span class="font-bold">Tunai</span>
                </label>
                
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="metode_pembayaran" value="Transfer" class="mr-3">
                    <i class="fas fa-university text-blue-600 text-2xl mr-3"></i>
                    <span class="font-bold">Transfer Bank</span>
                </label>
                
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="metode_pembayaran" value="QRIS" class="mr-3">
                    <i class="fas fa-qrcode text-purple-600 text-2xl mr-3"></i>
                    <span class="font-bold">QRIS</span>
                </label>
                
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="metode_pembayaran" value="Kartu Debit/Kredit" class="mr-3">
                    <i class="fas fa-credit-card text-orange-600 text-2xl mr-3"></i>
                    <span class="font-bold">Kartu Debit/Kredit</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 font-bold">
                    <i class="fas fa-check"></i> Konfirmasi
                </button>
                <button type="button" onclick="closePaymentModal()" class="bg-gray-400 text-white px-6 py-3 rounded-lg hover:bg-gray-500">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openPaymentModal() {
    document.getElementById('paymentModal').classList.remove('hidden');
}

function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
}
</script>
@endpush
@endsection
