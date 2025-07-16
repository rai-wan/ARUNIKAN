<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-6 font-sans">

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center text-blue-700">Riwayat Transaksi Anda</h1>

    @if(isset($error))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">{{ $error }}</div>
    @endif

    @if(count($riwayat) === 0)
        <p class="text-center text-gray-500">Belum ada transaksi ditemukan.</p>
    @else
        @foreach($riwayat as $nota)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="md:flex">
                    {{-- Gambar produk --}}
                    <div class="md:w-1/3">
                        <img src="{{ $nota['gambar_produk'] ?? 'https://via.placeholder.com/300x200' }}" alt="Gambar Produk" class="object-cover w-full h-full">
                    </div>

                    {{-- Detail --}}
                    <div class="md:w-2/3 p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-xl font-semibold">Nota Transaksi</h2>
                            <span class="text-sm font-semibold px-3 py-1 rounded 
                                {{ $nota['status_pembayaran'] === 'terverifikasi' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($nota['status_pembayaran']) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <p><strong>Nama Pembeli:</strong> {{ $nota['nama_pembeli'] }}</p>
                            <p><strong>Produk:</strong> {{ $nota['nama_produk'] ?? 'Produk #' . $nota['produk'] }}</p>

                            <p><strong>Jumlah:</strong> {{ $nota['jumlah'] }}</p>
                            <p><strong>Harga Satuan:</strong> Rp{{ number_format(($nota['total_harga'] / $nota['jumlah']), 0, ',', '.') }}</p>

                            <p><strong>Total Harga:</strong> Rp{{ number_format($nota['total_harga'], 0, ',', '.') }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($nota['metode_pembayaran']) }}</p>

                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($nota['tanggal'])->format('d-m-Y H:i') }}</p>
                            <p><strong>Lokasi Pengantaran:</strong> 
                                <a href="{{ $nota['lokasi_pengantaran'] }}" class="text-blue-600 underline" target="_blank">Lihat</a>
                            </p>

                            <p><strong>Bukti Transfer:</strong> 
                                <a href="{{ $nota['bukti_transfer'] }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="text-center mt-8">
        <a href="/dashboard" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
