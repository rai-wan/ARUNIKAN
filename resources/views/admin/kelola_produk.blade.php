<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Produk | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Kelola Produk</h1>

        {{-- Alert sukses atau error --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tombol kembali ke dashboard dan tambah produk --}}
        <div class="mb-4 flex space-x-4">
            <a href="{{ url('/admin/dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">⬅ Kembali ke Dashboard</a>
            <a href="{{ url('/admin/produk/tambah') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">+ Tambah Produk</a>
        </div>

        {{-- Tabel Produk --}}
        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Deskripsi</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Kategori</th>
                        <th class="px-4 py-2 text-left">Promo</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $index => $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $item['nama'] }}</td>
                            <td class="px-4 py-2">{{ $item['deskripsi'] }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $item['kategori']['nama'] ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item['promo']['nama'] ?? '-' }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ url('/admin/produk/edit/' . $item['id']) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ url('/admin/produk/hapus/' . $item['id']) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin hapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
