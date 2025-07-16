<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Stok Masuk Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Stok Masuk Produk</h1>
            <a href="/admin/dashboard" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                ← Kembali ke Dashboard
            </a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4">

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Info Produk --}}
        <div class="bg-white shadow rounded p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Produk Tersedia</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($produk as $item)
                    <div class="border rounded p-4 shadow-sm bg-gray-50">
                        <h3 class="font-semibold text-lg">{{ $item['nama'] }}</h3>
                        <p class="text-sm text-gray-600">Stok Saat Ini: <strong>{{ $item['stok'] }}</strong></p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Form Tambah Stok Masuk --}}
        <div class="bg-white shadow rounded p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Tambah Stok Masuk</h2>
            <form action="{{ route('admin.stok.simpan') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Pilih Produk</label>
                        <select name="produk_id" class="w-full border rounded p-2" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($produk as $item)
                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Jumlah</label>
                        <input type="number" name="jumlah" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Harga Satuan</label>
                        <input type="number" name="harga_satuan" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Keterangan (opsional)</label>
                        <input type="text" name="keterangan" class="w-full border rounded p-2">
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan Stok
                    </button>
                </div>
            </form>
        </div>

        {{-- Riwayat Stok Masuk --}}
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-bold mb-4">Riwayat Stok Masuk</h2>
            @if(!empty($stokMasuk) && is_countable($stokMasuk))
                <table class="w-full table-auto text-left border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 border">Tanggal</th>
                            <th class="p-2 border">Produk</th>
                            <th class="p-2 border">Jumlah</th>
                            <th class="p-2 border">Harga Satuan</th>
                            <th class="p-2 border">Subtotal</th>
                            <th class="p-2 border">Suplayer</th>
                            <th class="p-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokMasuk as $stok)
                            <tr>
                                <td class="p-2 border">{{ $stok['tanggal_masuk'] }}</td>
                                <td class="p-2 border">{{ $stok['nama_produk'] }}</td>
                                <td class="p-2 border">{{ $stok['jumlah'] }}</td>
                                <td class="p-2 border">Rp{{ number_format($stok['harga_satuan'], 0, ',', '.') }}</td>
                                <td class="p-2 border">Rp{{ number_format($stok['subtotal'], 0, ',', '.') }}</td>
                                <td class="p-2 border">{{ $stok['nama_suplayer'] ?? '-' }}</td>
                                <td class="p-2 border">{{ $stok['keterangan'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Belum ada data stok masuk.</p>
            @endif
        </div>

    </div>

</body>
</html>
