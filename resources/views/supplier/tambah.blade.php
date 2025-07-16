<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk - Supplier</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>

  <form action="/supplier/simpan" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow w-full max-w-lg">
    @csrf

    <div class="mb-4">
      <label class="block text-gray-700">Nama Produk</label>
      <input type="text" name="nama" required class="w-full px-4 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Harga</label>
      <input type="number" name="harga" required class="w-full px-4 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Stok</label>
      <input type="number" name="stok" required class="w-full px-4 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Deskripsi</label>
      <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded"></textarea>
    </div>

    <!-- Kategori -->
    <div class="mb-4">
      <label class="block text-gray-700">Kategori</label>
      <select name="kategori_id" class="w-full px-4 py-2 border rounded" required>
        <option disabled selected value="">-- Pilih Kategori --</option>
        @if(!empty($kategori) && is_array($kategori))
          @foreach($kategori as $k)
            <option value="{{ $k['id'] }}">
              {{ $k['nama_kategori'] ?? $k['nama'] ?? 'Kategori Tanpa Nama' }}
            </option>
          @endforeach
        @else
          <option value="">(Kategori tidak tersedia)</option>
        @endif
      </select>
    </div>

    <!-- Promo -->
    <div class="mb-4">
      <label class="block text-gray-700">Promo</label>
      <select name="promo_id" class="w-full px-4 py-2 border rounded">
        <option disabled selected value="">-- Pilih Promo --</option>
        @if(!empty($promo) && is_array($promo))
          @foreach($promo as $p)
            <option value="{{ $p['id'] }}">
              {{ $p['nama'] ?? 'Promo Tanpa Nama' }}
            </option>
          @endforeach
        @else
          <option value="">(Promo tidak tersedia)</option>
        @endif
      </select>
    </div>

    <div class="mb-6">
      <label class="block text-gray-700">Upload Gambar</label>
      <input type="file" name="gambar" class="w-full">
    </div>

    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">Simpan</button>
    <a href="/supplier" class="ml-4 text-blue-600 hover:underline">Kembali</a>
  </form>
</body>
</html>
