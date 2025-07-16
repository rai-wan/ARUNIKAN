<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Form Pembayaran</h2>

        {{-- Informasi Produk --}}
        <div class="flex flex-col md:flex-row gap-6 mb-6">
            <div class="w-full md:w-1/3">
                <img src="{{ $produk['gambar'] ?? 'https://via.placeholder.com/150' }}" 
                     alt="Gambar Produk" 
                     class="w-full h-40 object-cover rounded border">
            </div>
            <div class="w-full md:w-2/3">
                <h3 class="text-xl font-bold">{{ $produk['nama'] ?? '-' }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ $produk['deskripsi'] ?? 'Tidak ada deskripsi' }}</p>
                <p class="text-sm">Kategori: <strong>{{ $produk['kategori']['nama'] ?? '-' }}</strong></p>
                <p class="text-sm">Promo: <strong>{{ $produk['promo']['nama'] ?? '-' }}</strong></p>
                <p class="text-sm mt-2">Harga Satuan: <strong>Rp{{ number_format($produk['harga'] ?? 0, 0, ',', '.') }}</strong></p>
                <p class="text-sm">Stok Tersedia: <strong>{{ $produk['stok'] ?? 0 }}</strong></p>
            </div>
        </div>

        {{-- Form Pembayaran --}}
    <form action="{{ route('shop.transaksi.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk['id'] }}">
        
        <div class="mb-4">
            <label class="font-medium">Nama Produk</label>
            <input type="text" value="{{ $produk['nama'] }}" readonly class="w-full p-2 border rounded bg-gray-100">
        </div>

        <div class="mb-4">
            <label class="font-medium">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" value="{{ $jumlah }}" min="1" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Harga Satuan</label>
            <input type="number" id="harga" value="{{ $produk['harga'] }}" readonly class="w-full p-2 border rounded bg-gray-100">
        </div>

        <div class="mb-4">
            <label class="font-medium">Total Harga</label>
            <input type="number" name="total_harga" id="total_harga" readonly class="w-full p-2 border rounded bg-gray-100">
        </div>

        <div class="mb-4">
            <label class="font-medium">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Lokasi Pengantaran</label>
            <textarea name="lokasi_pengantaran" id="lokasi_pengantaran" class="w-full p-2 border rounded" placeholder="Tulis alamat atau klik tombol bawah"></textarea>
            <button type="button" onclick="getLocation()" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded">📍 Gunakan Lokasi Sekarang</button>
        </div>

        <div class="mb-4">
            <label class="font-medium">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="w-full p-2 border rounded" required>
                <option value="">-- Pilih --</option>
                <option value="qris">QRIS</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="font-medium">Bukti Transfer</label>
            <input type="file" name="bukti_transfer" accept="image/*" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Kirim Pembayaran</button>
    </form>

    <script>
        function hitungTotal() {
            let jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            let harga = parseInt(document.getElementById('harga').value) || 0;
            document.getElementById('total_harga').value = jumlah * harga;
        }

        document.getElementById('jumlah').addEventListener('input', hitungTotal);
        window.addEventListener('load', hitungTotal);

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let lat = position.coords.latitude;
                    let long = position.coords.longitude;
                    document.getElementById('lokasi_pengantaran').value = `https://www.google.com/maps?q=${lat},${long}`;
                });
            } else {
                alert("Browser tidak mendukung lokasi.");
            }
        }
    </script>


</body>
</html>
