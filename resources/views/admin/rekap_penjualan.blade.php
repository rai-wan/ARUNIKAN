<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Rekap Penjualan & Pengeluaran</h1>

        <div class="flex justify-between mb-6">
            <div>
                <a href="{{ route('rekap.export.pdf') }}" 
                class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded shadow">
                    Export PDF
                </a>
            </div>
            <a href="{{ route('admin.dashboard') }}" 
            class="inline-block bg-gray-400 hover:bg-gray-500 text-white font-medium px-4 py-2 rounded shadow">
                Kembali ke Dashboard
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Tanggal</th>
                        <th class="py-3 px-4 text-left">Tipe</th>
                        <th class="py-3 px-4 text-left">Produk</th>
                        <th class="py-3 px-4 text-center">Jumlah</th>
                        <th class="py-3 px-4 text-right">Harga Satuan</th>
                        <th class="py-3 px-4 text-right">Total</th>
                        <th class="py-3 px-4 text-left">Sumber</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekap as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ date('d M Y', strtotime($item['tanggal'])) }}</td>
                        <td class="py-3 px-4">
                            <span class="text-sm px-2 py-1 rounded 
                                {{ $item['tipe'] === 'Pengeluaran (Stok Masuk)' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                {{ $item['tipe'] }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $item['produk'] }}</td>
                        <td class="py-3 px-4 text-center">{{ $item['jumlah'] }}</td>
                        <td class="py-3 px-4 text-right">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-right font-semibold">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                        <td class="py-3 px-4">{{ $item['sumber'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-6">Belum ada data transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="text-sm text-gray-500 mt-6 text-center">
            Data ini mencakup semua aktivitas penjualan dan pengeluaran yang telah tercatat di sistem.
        </p>
    </div>

</body>
</html>
