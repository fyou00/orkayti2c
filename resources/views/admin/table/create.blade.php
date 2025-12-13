{{-- resources/views/admin/table/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Meja')
@section('page-title', 'Tambah Meja Baru')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.table.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Nomor Meja <span class="text-red-500">*</span></label>
                <input type="number" name="nomor" value="{{ old('nomor') }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" min="1" required>
                @error('nomor')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Kapasitas <span class="text-red-500">*</span></label>
                <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" min="1" max="50" required>
                <p class="text-sm text-gray-600 mt-1">Jumlah orang yang dapat duduk di meja ini</p>
                @error('kapasitas')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                    <option value="tersedia" {{ old('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terisi" {{ old('status') === 'terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="reserved" {{ old('status') === 'reserved' ? 'selected' : '' }}>Reserved</option>
                </select>
                @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.table.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
