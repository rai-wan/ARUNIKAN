<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10 text-gray-800 font-sans">

    <div class="max-w-4xl mx-auto bg-white p-10 rounded-lg shadow-lg">
        <div class="border-b pb-4 mb-6">
            <h1 class="text-3xl font-bold text-center text-blue-800 uppercase">Nota Pembayaran</h1>
        </div>

        {{-- Informasi Produk --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <img src="{{ $produk['gambar'] ?? 'https://via.placeholder.com/200' }}" 
                     alt="Gambar Produk" 
                     class="w-full h-60 object-cover rounded border">
            </div>
            <div class="space-y-2">
                <h2 class="text-2xl font-semibold">{{ $produk['nama'] ?? '-' }}</h2>
                <p class="text-base">{{ $produk['deskripsi'] ?? '-' }}</p>
                <p><strong>Kategori:</strong> {{ $produk['kategori']['nama'] ?? '-' }}</p>
                <p><strong>Promo:</strong> {{ $produk['promo']['nama'] ?? '-' }}</p>
                <p><strong>Harga Satuan:</strong> Rp{{ number_format($produk['harga'] ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Detail Transaksi --}}
        <div class="bg-gray-50 border p-6 rounded space-y-3">
            <h3 class="text-xl font-bold mb-4 border-b pb-2">Detail Transaksi</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>Nama Pembeli:</strong> {{ $nota['nama_pembeli'] }}</p>
                <p><strong>Jumlah Beli:</strong> {{ $nota['jumlah'] }}</p>
                <p><strong>Total Harga:</strong> Rp{{ number_format($nota['total_harga'], 0, ',', '.') }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($nota['metode_pembayaran']) }}</p>
                <p><strong>Status Pembayaran:</strong>
                    @if($nota['status_pembayaran'] == 'pending')
                        <span class="text-yellow-600 font-bold">Pending</span>
                    @else
                        <span class="text-green-600 font-bold">Terverifikasi</span>
                    @endif
                </p>
                <p><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($nota['tanggal'])->format('d-m-Y H:i') }}</p>
                <p><strong>Lokasi Pengantaran:</strong> 
                    <a href="{{ $nota['lokasi_pengantaran'] }}" class="text-blue-600 underline" target="_blank">
                        Lihat Lokasi
                    </a>
                </p>
                <p><strong>Bukti Transfer:</strong> 
                    <a href="{{ $nota['bukti_transfer'] }}" class="text-blue-600 underline" target="_blank">
                        Lihat Bukti Transfer
                    </a>
                </p>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-8 text-center">
            <a href="/shop" class="inline-block bg-blue-600 text-white text-lg px-6 py-3 rounded hover:bg-blue-700 transition">
                Kembali ke Shop
            </a>
        </div>
    </div>

</body>
</html>
