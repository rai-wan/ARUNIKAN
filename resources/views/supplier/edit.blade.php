@extends('layouts.supplier')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-green-700">Edit Produk</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('/supplier/update/' . $produk['id']) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Produk (readonly) --}}
        <div class="mb-4">
            <label class="block text-sm font-medium">Nama Produk</label>
            <input type="text" name="nama" value="{{ $produk['nama'] }}" 
                   class="w-full border px-3 py-2 rounded bg-gray-100" disabled>
        </div>

        {{-- Tambah Stok --}}
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium">Tambah Stok</label>
            <input type="number" name="jumlah" id="jumlah" required min="1"
                   class="w-full border px-3 py-2 rounded" placeholder="Contoh: 10">
        </div>

        {{-- Harga Satuan --}}
        <div class="mb-4">
            <label for="harga_satuan" class="block text-sm font-medium">Harga Satuan (Rp)</label>
            <input type="number" name="harga_satuan" id="harga_satuan" 
                   value="{{ $produk['harga'] }}" required min="0"
                   class="w-full border px-3 py-2 rounded" placeholder="Contoh: 10000">
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label for="kategori_id" class="block text-sm font-medium">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="w-full border px-3 py-2 rounded" required>
                @foreach($kategori as $kat)
                    <option value="{{ $kat['id'] }}" 
                        {{ $produk['kategori']['id'] == $kat['id'] ? 'selected' : '' }}>
                        {{ $kat['nama'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Promo --}}
        <div class="mb-6">
            <label for="promo_id" class="block text-sm font-medium">Promo (Opsional)</label>
            <select name="promo_id" id="promo_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Tidak ada promo --</option>
                @foreach($promo as $pr)
                    <option value="{{ $pr['id'] }}" 
                        {{ isset($produk['promo']) && $produk['promo']['id'] == $pr['id'] ? 'selected' : '' }}>
                        {{ $pr['nama'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Submit --}}
        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update Produk
            </button>
        </div>
    </form>
</div>
@endsection
