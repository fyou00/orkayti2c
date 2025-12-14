@extends('layouts.cashier')

@section('title', 'Daftar Pesanan')
@section('page-title', 'Daftar Pesanan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <form action="{{ route('cashier.order.index') }}" method="GET" class="flex gap-2">
            <!-- Search Form -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pelanggan..." class="border rounded px-4 py-2 w-64">
            <select name="status" class="border rounded px-4 py-2" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                <i class="fas fa-search"></i>
            </button>
            <!-- Search Form -->
        </form>
    </div>
    <a href="{{ route('cashier.order.create') }}" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 font-bold text-lg">
        <i class="fas fa-plus-circle"></i> Pesanan Baru
    </a>
</div>

<!-- Status Pesanan -->
<div class="grid md:grid-cols-3 gap-6 mb-6">
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex items-center">
            <div class="bg-yellow-400 p-3 rounded-lg mr-4">
                <i class="fas fa-clock text-white text-2xl"></i>
            </div>
            <div>
                <p class="text-yellow-800 font-bold text-2xl">{{ $countMenunggu }}</p>
                <p class="text-yellow-700">Menunggu</p>
            </div>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-center">
            <div class="bg-blue-400 p-3 rounded-lg mr-4">
                <i class="fas fa-shopping-cart text-white text-2xl"></i>
            </div>
            <div>
                <p class="text-blue-800 font-bold text-2xl">{{ $countDiproses }}</p>
                <p class="text-blue-700">Diproses</p>
            </div>
        </div>
    </div>
    
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center">
            <div class="bg-green-400 p-3 rounded-lg mr-4">
                <i class="fas fa-check-circle text-white text-2xl"></i>
            </div>
            <div>
                <p class="text-green-800 font-bold text-2xl">{{ $countSelesai }}</p>
                <p class="text-green-700">Selesai</p>
            </div>
        </div>
    </div>
</div>
<!-- Status Pesanan -->

<!-- List Pesanan -->
<div class="bg-white rounded-lg shadow">
    @forelse($orders as $order)
    <div class="border-b p-6 hover:bg-gray-50 transition">
        <div class="flex justify-between items-start">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-xl font-bold">{{ $order->nama_pelanggan }}</h3>
                    <span class="px-3 py-1 rounded-full text-sm font-bold
                        @if($order->status === 'menunggu') bg-yellow-100 text-yellow-700
                        @elseif($order->status === 'diproses') bg-blue-100 text-blue-700
                        @else bg-green-100 text-green-700 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                
                <div class="text-sm text-gray-600 mb-3">
                    <span class="mr-4">
                        <i class="fas fa-clock"></i> {{ $order->created_at->format('H:i, d M Y') }}
                    </span>
                    @if($order->table)
                        <span class="mr-4">
                            <i class="fas fa-table"></i> Meja {{ $order->table->nomor }}
                        </span>
                    @else
                        <span class="mr-4">
                            <i class="fas fa-shopping-bag"></i> Take Away
                        </span>
                    @endif
                    <span>
                        <i class="fas fa-utensils"></i> {{ $order->items->count() }} item
                    </span>
                </div>

                <div class="mb-3">
                    @foreach($order->items as $item)
                        <span class="inline-block bg-gray-100 rounded px-3 py-1 text-sm mr-2 mb-2">
                            {{ $item->qty }}x {{ $item->menu->nama }}
                        </span>
                    @endforeach
                </div>

                <p class="text-2xl font-bold text-orange-600">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </p>
            </div>

            <div class="flex flex-col gap-2 ml-4">
                <a href="{{ route('cashier.order.show', $order) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-center whitespace-nowrap">
                    <i class="fas fa-eye"></i> Detail
                </a>
                
                @if($order->status === 'menunggu')
                    <form action="{{ route('cashier.order.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="diproses">
                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 whitespace-nowrap">
                            <i class="fas fa-play"></i> Proses
                        </button>
                    </form>
                @elseif($order->status === 'diproses')
                    <button onclick="openPaymentModal({{ $order->id }})" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 whitespace-nowrap">
                        <i class="fas fa-check"></i> Selesai
                    </button>
                @endif
                
                @if($order->status !== 'selesai')
                    <form action="{{ route('cashier.order.destroy', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 whitespace-nowrap">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="p-12 text-center text-gray-500">
        <i class="fas fa-shopping-cart text-6xl mb-4"></i>
        <p class="text-xl">Tidak ada pesanan</p>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-2xl font-bold mb-4">Pilih Metode Pembayaran</h3>
        <form id="paymentForm" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="selesai">
            
            <div class="space-y-3 mb-6">
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="metode_pembayaran" value="Tunai" class="mr-3" required>
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
                    <i class="fas fa-check"></i> Konfirmasi Pembayaran
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
function openPaymentModal(orderId) {
    document.getElementById('paymentForm').action = `/cashier/pesanan/${orderId}/status`;
    document.getElementById('paymentModal').classList.remove('hidden');
}

function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
}
</script>
@endpush
@endsection