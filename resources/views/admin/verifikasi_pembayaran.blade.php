<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Pembayaran - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <div class="bg-blue-700 text-white px-6 py-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Verifikasi Pembayaran - Admin</h1>
            <a href="/admin/dashboard" class="text-sm underline hover:text-gray-200">Kembali ke Dashboard</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- ================= BAGIAN PENDING ================= --}}
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Menunggu Verifikasi</h2>

        <div class="bg-white shadow rounded overflow-x-auto mb-10">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Produk</th>
                        <th class="p-3 text-left">Jumlah</th>
                        <th class="p-3 text-left">Metode</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Bukti</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 bg-white divide-y">
                    @forelse ($pending as $t)
                        <tr>
                            <td class="p-3">{{ $t['nama_pembeli'] }}</td>
                            <td class="p-3">{{ $t['produk'] }}</td>
                            <td class="p-3">{{ $t['jumlah'] }}</td>
                            <td class="p-3 capitalize">{{ $t['metode_pembayaran'] }}</td>
                            <td class="p-3">Rp {{ number_format($t['total_harga'], 0, ',', '.') }}</td>
                            <td class="p-3">
                                @if ($t['bukti_transfer'])
                                    <a href="{{ $t['bukti_transfer'] }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">Lihat</a>
                                @else
                                    <span class="text-gray-400">Tidak Ada</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <form action="{{ route('admin.verifikasi_pembayaran.proses', $t['id']) }}" method="POST" onsubmit="return confirm('Verifikasi pembayaran ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                        Verifikasi
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada pembayaran pending.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ================= BAGIAN SUDAH DIVERIFIKASI ================= --}}
        <h2 class="text-xl font-semibold text-green-700 mb-4">Sudah Diverifikasi</h2>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Produk</th>
                        <th class="p-3 text-left">Jumlah</th>
                        <th class="p-3 text-left">Metode</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Bukti</th>
                        <th class="p-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 bg-white divide-y">
                    @forelse ($terverifikasi as $t)
                        <tr>
                            <td class="p-3">{{ $t['nama_pembeli'] }}</td>
                            <td class="p-3">{{ $t['produk'] }}</td>
                            <td class="p-3">{{ $t['jumlah'] }}</td>
                            <td class="p-3 capitalize">{{ $t['metode_pembayaran'] }}</td>
                            <td class="p-3">Rp {{ number_format($t['total_harga'], 0, ',', '.') }}</td>
                            <td class="p-3">
                                @if ($t['bukti_transfer'])
                                    <a href="{{ $t['bukti_transfer'] }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">Lihat</a>
                                @else
                                    <span class="text-gray-400">Tidak Ada</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded">Terverifikasi</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-500">Belum ada data terverifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
