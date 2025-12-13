
@extends('layouts.admin')

@section('title', 'Kelola Meja')
@section('page-title', 'Kelola Meja')

@section('content')
<div class="mb-6">
    <div class="grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600">Total Meja</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalTables }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600">Meja Tersedia</p>
            <p class="text-3xl font-bold text-green-600">{{ $tableTersedia }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600">Meja Terisi</p>
            <p class="text-3xl font-bold text-orange-600">{{ $tableTerisi }}</p>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <form action="{{ route('admin.table.index') }}" method="GET" class="flex gap-2">
            <select name="status" class="border rounded px-4 py-2" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
            </select>
        </form>
        <a href="{{ route('admin.table.create') }}" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">
            <i class="fas fa-plus"></i> Tambah Meja
        </a>
    </div>
</div>

<div class="grid md:grid-cols-4 gap-6">
    @forelse($tables as $table)
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-3xl font-bold text-gray-800">Meja {{ $table->nomor }}</h3>
                <p class="text-gray-600">
                    <i class="fas fa-users"></i> Kapasitas: {{ $table->kapasitas }} orang
                </p>
            </div>
            <span class="px-3 py-1 rounded-full text-sm font-bold
                @if($table->status === 'tersedia') bg-green-100 text-green-700
                @elseif($table->status === 'terisi') bg-orange-100 text-orange-700
                @else bg-blue-100 text-blue-700 @endif">
                {{ ucfirst($table->status) }}
            </span>
        </div>
        
        <div class="flex gap-2">
            <a href="{{ route('admin.table.edit', $table) }}" class="flex-1 bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 text-center">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.table.destroy', $table) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus meja ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-4 text-center py-12">
        <i class="fas fa-table text-6xl text-gray-300 mb-4"></i>
        <p class="text-xl text-gray-500">Belum ada meja</p>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $tables->links() }}
</div>
@endsection