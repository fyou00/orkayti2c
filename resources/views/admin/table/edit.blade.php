{{-- resources/views/admin/table/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Meja')
@section('page-title', 'Edit Meja')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.table.update', $table) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Nomor Meja <span class="text-red-500">*</span></label>
                <input type="number" name="nomor" value="{{ old('nomor', $table->nomor) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" min="1" required>
                @error('nomor')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Kapasitas <span class="text-red-500">*</span></label>
                <input type="number" name="kapasitas" value="{{ old('kapasitas', $table->kapasitas) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" min="1" max="50" required>
                @error('kapasitas')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                    <option value="tersedia" {{ old('status', $table->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terisi" {{ old('status', $table->status) === 'terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="reserved" {{ old('status', $table->status) === 'reserved' ? 'selected' : '' }}>Reserved</option>
                </select>
                @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.table.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
