@extends('layouts.admin')

@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Nama Menu <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $menu->nama) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                @error('nama')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="kategori" value="{{ old('kategori', $menu->kategori) }}" list="categories" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                <datalist id="categories">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">
                    @endforeach
                </datalist>
                @error('kategori')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Harga <span class="text-red-500">*</span></label>
                <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" min="0" required>
                @error('harga')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                    <option value="tersedia" {{ old('status', $menu->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status', $menu->status) === 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-2">Foto Menu</label>
                @if($menu->foto)
                    <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama }}" class="w-48 h-48 object-cover rounded mb-3">
                @endif
                <input type="file" name="foto" accept="image/*" class="w-full border rounded px-4 py-2" onchange="previewImage(event)">
                <p class="text-sm text-gray-600 mt-1">Biarkan kosong jika tidak ingin mengubah foto</p>
                @error('foto')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                <img id="preview" class="mt-4 w-48 h-48 object-cover rounded hidden">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.menu.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }
}
</script>
@endpush
@endsection