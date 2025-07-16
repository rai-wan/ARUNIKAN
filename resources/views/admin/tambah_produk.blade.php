<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">

    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Tambah Produk Baru</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- FORM MULAI --}}
        <form action="{{ route('admin.produk.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Nama Produk --}}
            <div>
                <label class="block font-medium mb-1">Nama Produk</label>
                <input type="text" name="nama" required class="w-full border p-2 rounded" placeholder="Contoh: Ikan Koi" />
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full border p-2 rounded" placeholder="Deskripsi singkat produk..."></textarea>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block font-medium mb-1">Harga</label>
                <input type="number" name="harga" required class="w-full border p-2 rounded" placeholder="Contoh: 20000" />
            </div>

            {{-- Stok --}}
            <div>
                <label class="block font-medium mb-1">Stok Awal</label>
                <input type="number" name="stok" required class="w-full border p-2 rounded" placeholder="Contoh: 50" />
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block font-medium mb-1">Kategori</label>
                <select name="kategori" required class="w-full border p-2 rounded">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori['id'] }}">{{ $kategori['nama'] }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Promo --}}
            <div>
                <label class="block font-medium mb-1">Promo (Opsional)</label>
                <select name="promo" class="w-full border p-2 rounded">
                    <option value="">-- Tanpa Promo --</option>
                    @foreach($promoList as $promo)
                        <option value="{{ $promo['id'] }}">
                            {{ $promo['nama'] }}
                            {{-- Hindari error jika key 'diskon' tidak ada --}}
                            @if(array_key_exists('diskon', $promo))
                                ({{ $promo['diskon'] }}%)
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Upload Gambar --}}
            <div>
                <label class="block font-medium mb-1">Gambar Produk</label>
                <input type="file" name="gambar" accept="image/*" class="w-full border p-2 rounded bg-white" required />
            </div>

            {{-- Tombol --}}
            <div class="text-center pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Produk</button>
                <a href="{{ url('/admin/produk') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>
