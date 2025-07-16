<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Transaksi Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white p-4 shadow">
        <div class="text-xl font-bold text-blue-600">Arunikan Kasir</div>
    </nav>

    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Form Transaksi</h2>

        @if($bukan_kasir)
            <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-md text-center shadow-sm">
                <p class="mb-2 font-medium">Form hanya bisa diakses oleh role kasir.</p>
                <a href="/dashboard" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Kembali ke Dashboard
                </a>
            </div>
        @else
            <form action="{{ route('kasir.simpan') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nama_konsumen" class="block font-medium mb-1">Nama Konsumen</label>
                    <input type="text" name="nama_konsumen" id="nama_konsumen" required class="w-full border p-2 rounded" placeholder="Masukkan nama">
                </div>

                <div class="mb-4">
                    <label for="produk" class="block font-medium mb-1">Produk</label>
                    <select name="produk" id="produk" required class="w-full border p-2 rounded">
                        @foreach ($produk as $item)
                            <option value="{{ $item['id'] }}" {{ $item['id'] == $produk_terpilih ? 'selected' : '' }}>
                                {{ $item['nama'] }} - Rp{{ number_format($item['harga'], 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="jumlah" class="block font-medium mb-1">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ $jumlah_default ?? 1 }}" required class="w-full border p-2 rounded">
                </div>

                <div class="mb-4">
                    <label for="total" class="block font-medium mb-1">Total Harga</label>
                    <input type="number" name="total" id="total" class="w-full border p-2 rounded" placeholder="Total akan dihitung manual">
                </div>

                <div class="mb-4">
                    <label for="jenis_payment" class="block font-medium mb-1">Metode Pembayaran</label>
                    <select name="jenis_payment" id="jenis_payment" required class="w-full border p-2 rounded">
                        @foreach ($pembayaran as $item)
                            <option value="{{ $item['id'] }}">{{ $item['nama_pembayaran'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Transaksi</button>
                </div>
            </form>
        @endif
    </div>

</body>
</html>
