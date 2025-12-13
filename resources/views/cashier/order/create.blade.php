{{-- resources/views/cashier/order/create.blade.php --}}
@extends('layouts.cashier')

@section('title', 'Buat Pesanan Baru')
@section('page-title', 'Buat Pesanan Baru')

@section('content')
<form action="{{ route('cashier.order.store') }}" method="POST" id="orderForm">
    @csrf
    
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Left: Menu Selection -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-xl font-bold mb-4">Pilih Menu</h3>
                
                <!-- Search Menu -->
                <input type="text" id="searchMenu" placeholder="Cari menu..." class="w-full border rounded px-4 py-2 mb-4">
                
                @foreach($menusByCategory as $kategori => $menus)
                <div class="mb-6">
                    <h4 class="text-lg font-bold mb-3 text-orange-600">{{ $kategori }}</h4>
                    <div class="grid md:grid-cols-2 gap-3">
                        @foreach($menus as $menu)
                        <div class="menu-item border rounded-lg p-4 hover:bg-orange-50 cursor-pointer transition" onclick="addItem({{ $menu->id }}, '{{ $menu->nama }}', {{ $menu->harga }})">
                            <div class="flex items-center">
                                @if($menu->foto)
                                    <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama }}" class="w-16 h-16 object-cover rounded mr-3">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-utensils text-gray-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold">{{ $menu->nama }}</p>
                                    <p class="text-sm text-orange-600 font-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Order Summary -->
        <div>
            <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                <h3 class="text-xl font-bold mb-4">Detail Pesanan</h3>
                
                <div class="mb-4">
                    <label class="block font-bold mb-2">Nama Pelanggan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="w-full border rounded px-4 py-2" placeholder="Masukkan nama pelanggan" required>
                    @error('nama_pelanggan')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Pilih Meja (Opsional)</label>
                    <select name="table_id" class="w-full border rounded px-4 py-2">
                        <option value="">Tanpa Meja / Take Away</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}">Meja {{ $table->nomor }} ({{ $table->kapasitas }} orang)</option>
                        @endforeach
                    </select>
                </div>

                <div class="border-t pt-4 mb-4">
                    <h4 class="font-bold mb-3">Item Pesanan</h4>
                    <div id="orderItems" class="space-y-2 max-h-64 overflow-y-auto mb-4">
                        <p class="text-gray-500 text-center py-4" id="emptyMessage">Belum ada item dipilih</p>
                    </div>
                </div>

                <div class="border-t pt-4 mb-6">
                    <div class="flex justify-between text-xl font-bold">
                        <span>Total:</span>
                        <span class="text-orange-600" id="totalPrice">Rp 0</span>
                    </div>
                </div>

                <button type="submit" id="submitBtn" class="w-full bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 font-bold text-lg disabled:bg-gray-400 disabled:cursor-not-allowed" disabled>
                    <i class="fas fa-save"></i> Simpan Pesanan
                </button>
                <a href="{{ route('cashier.order.index') }}" class="w-full bg-gray-400 text-white px-6 py-3 rounded-lg hover:bg-gray-500 mt-3 block text-center">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
let orderItems = [];
let itemIdCounter = 0;

function addItem(menuId, menuName, price) {
    // Check if item already exists
    const existingIndex = orderItems.findIndex(item => item.menuId === menuId);
    
    if (existingIndex !== -1) {
        orderItems[existingIndex].qty++;
    } else {
        orderItems.push({
            id: itemIdCounter++,
            menuId: menuId,
            name: menuName,
            price: price,
            qty: 1
        });
    }
    
    updateOrderDisplay();
}

function removeItem(id) {
    orderItems = orderItems.filter(item => item.id !== id);
    updateOrderDisplay();
}

function updateQty(id, change) {
    const item = orderItems.find(item => item.id === id);
    if (item) {
        item.qty += change;
        if (item.qty <= 0) {
            removeItem(id);
        } else {
            updateOrderDisplay();
        }
    }
}

function updateOrderDisplay() {
    const container = document.getElementById('orderItems');
    const emptyMessage = document.getElementById('emptyMessage');
    const submitBtn = document.getElementById('submitBtn');
    
    if (orderItems.length === 0) {
        emptyMessage.classList.remove('hidden');
        container.innerHTML = '<p class="text-gray-500 text-center py-4" id="emptyMessage">Belum ada item dipilih</p>';
        submitBtn.disabled = true;
        document.getElementById('totalPrice').textContent = 'Rp 0';
        return;
    }
    
    emptyMessage.classList.add('hidden');
    submitBtn.disabled = false;
    
    let html = '';
    let total = 0;
    
    orderItems.forEach(item => {
        const subtotal = item.price * item.qty;
        total += subtotal;
        
        html += `
            <div class="flex justify-between items-center bg-gray-50 p-3 rounded">
                <div class="flex-1">
                    <p class="font-bold text-sm">${item.name}</p>
                    <p class="text-xs text-gray-600">Rp ${item.price.toLocaleString('id-ID')}</p>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="updateQty(${item.id}, -1)" class="bg-gray-300 w-6 h-6 rounded flex items-center justify-center hover:bg-gray-400">-</button>
                    <span class="font-bold w-8 text-center">${item.qty}</span>
                    <button type="button" onclick="updateQty(${item.id}, 1)" class="bg-gray-300 w-6 h-6 rounded flex items-center justify-center hover:bg-gray-400">+</button>
                    <button type="button" onclick="removeItem(${item.id})" class="text-red-600 ml-2">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="hidden" name="items[${item.id}][menu_id]" value="${item.menuId}">
                <input type="hidden" name="items[${item.id}][qty]" value="${item.qty}">
            </div>
        `;
    });
    
    container.innerHTML = html;
    document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Search menu functionality
document.getElementById('searchMenu').addEventListener('input', function(e) {
    const search = e.target.value.toLowerCase();
    document.querySelectorAll('.menu-item').forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(search) ? 'block' : 'none';
    });
});
</script>
@endpush
@endsection
