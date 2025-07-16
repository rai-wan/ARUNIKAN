<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center text-yellow-600">Edit Produk</h2>

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

        <form action="{{ route('admin.produk.update', $produk['id']) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama Produk</label>
                <input type="text" name="nama" value="{{ $produk['nama'] }}" required class="w-full border p-2 rounded" />
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full border p-2 rounded">{{ $produk['deskripsi'] }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Harga</label>
                <input type="number" name="harga" value="{{ $produk['harga'] }}" required class="w-full border p-2 rounded" />
            </div>

            <div>
                <label class="block font-medium mb-1">Kategori</label>
                <select name="kategori" required class="w-full border p-2 rounded">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori['id'] }}" {{ $kategori['id'] == $produk['kategori']['id'] ? 'selected' : '' }}>
                            {{ $kategori['nama'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Promo (Opsional)</label>
                <select name="promo" class="w-full border p-2 rounded">
                    <option value="">-- Tanpa Promo --</option>
                    @foreach($promoList as $promo)
                        <option value="{{ $promo['id'] }}" {{ isset($produk['promo']) && $promo['id'] == $produk['promo']['id'] ? 'selected' : '' }}>
                            {{ $promo['nama'] }}
                            @if(array_key_exists('diskon', $promo))
                                ({{ $promo['diskon'] }}%)
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center pt-4">
                <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700">Update Produk</button>
                <a href="{{ route('admin.produk') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>
