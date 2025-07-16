<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Pembayaran Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-xl">
        <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">Form Pembayaran</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('shop.transaksi.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Produk --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">Produk</label>
                <input type="text" name="produk_nama" value="{{ $produk['nama'] ?? 'Produk tidak ditemukan' }}" class="w-full p-2 border rounded bg-gray-100" readonly>
                <input type="hidden" name="produk_id" value="{{ $produk['id'] }}">
            </div>

            {{-- Nama Pembeli --}}
            <div class="mb-4">
                <label for="nama_pembeli" class="block font-semibold mb-1">Nama Pembeli</label>
                <input type="text" name="nama_pembeli" id="nama_pembeli" class="w-full p-2 border rounded" required>
            </div>

            {{-- Jumlah --}}
            <div class="mb-4">
                <label for="jumlah" class="block font-semibold mb-1">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ $jumlah }}" min="1" class="w-full p-2 border rounded" required>
            </div>

            {{-- Total Harga --}}
            <div class="mb-4">
                <label for="total_harga" class="block font-semibold mb-1">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga"
                       value="{{ ($produk['harga'] ?? 0) * $jumlah }}" class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>

            {{-- Metode Pembayaran --}}
            <div class="mb-4">
                <label for="metode_pembayaran" class="block font-semibold mb-1">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="w-full p-2 border rounded" required>
                    <option value="qris">QRIS</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

            {{-- Upload Bukti Transfer --}}
            <div class="mb-6">
                <label for="bukti_transfer" class="block font-semibold mb-1">Upload Bukti Transfer</label>
                <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*" class="w-full p-2 border rounded bg-white">
                <p class="text-sm text-gray-500 mt-1">File gambar maksimal 2MB.</p>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow">
                    Kirim Pembayaran
                </button>
            </div>
        </form>
    </div>

</body>
</html>
