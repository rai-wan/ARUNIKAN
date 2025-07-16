<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Shop - Arunikan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 text-gray-800 font-sans">

    <div class="bg-blue-700 text-white p-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Toko Produk Arunikan</h1>
            <a href="/dashboard" class="text-sm underline hover:text-gray-200">Kembali ke Dashboard</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6">

        @if (isset($error))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ $error }}
            </div>
        @endif

        {{-- Filter --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <input type="text" id="searchInput" placeholder="Cari produk..." class="w-full md:w-1/3 px-4 py-2 border rounded shadow-sm">

            <select id="filterKategori" class="w-full md:w-1/4 px-4 py-2 border rounded shadow-sm">
                <option value="">Semua Kategori</option>
                @foreach ($kategori_list as $kategori)
                    <option value="{{ $kategori }}">{{ ucfirst($kategori) }}</option>
                @endforeach
            </select>
        </div>

        {{-- Produk per Kategori --}}
        @foreach ($kategori_terbagi as $kategori => $items)
            <div class="mb-10 kategori-section" data-kategori="{{ $kategori }}">
                <h2 class="text-xl font-semibold text-blue-700 mb-4 border-b border-blue-300 pb-1">
                    {{ ucfirst($kategori) }}
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($items as $item)
                        <div class="bg-white rounded-lg shadow p-4 flex flex-col product-card"
                             data-nama="{{ strtolower($item['nama']) }}"
                             data-kategori="{{ $kategori }}">
                            @if (!empty($item['gambar']))
                                <img src="{{ $item['gambar'] }}" alt="{{ $item['nama'] }}" class="h-40 w-full object-cover rounded mb-3">
                            @else
                                <div class="h-40 bg-gray-100 flex items-center justify-center rounded mb-3 text-gray-400">
                                    Tidak ada gambar
                                </div>
                            @endif

                            <h3 class="text-lg font-semibold">{{ $item['nama'] }}</h3>
                            <p class="text-sm text-gray-600 mb-1">Stok: {{ $item['stok'] }}</p>
                            <p class="text-green-600 font-bold text-lg mb-2">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>

                            @if ($item['promo'])
                                <span class="text-sm bg-yellow-100 text-yellow-700 px-2 py-1 rounded mb-2 inline-block">
                                    Promo: {{ $item['promo']['nama'] }}
                                </span>
                            @endif

                            {{-- ✅ Revisi tombol Buy Now --}}
                            <form action="{{ url('/shop/pembayaran') }}" method="GET" class="mt-auto">
                                <input type="hidden" name="produk_id" value="{{ $item['id'] }}">
                                <input type="hidden" name="jumlah" value="1">
                                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                                    Buy Now
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const filterKategori = document.getElementById('filterKategori');
        const produkCards = document.querySelectorAll('.product-card');
        const kategoriSections = document.querySelectorAll('.kategori-section');

        function filterProduk() {
            const keyword = searchInput.value.toLowerCase();
            const kategoriFilter = filterKategori.value;

            kategoriSections.forEach(section => {
                const kategori = section.dataset.kategori;
                let anyVisible = false;

                section.querySelectorAll('.product-card').forEach(card => {
                    const nama = card.dataset.nama;
                    const cardKategori = card.dataset.kategori;

                    const matchNama = nama.includes(keyword);
                    const matchKategori = !kategoriFilter || cardKategori === kategoriFilter;

                    if (matchNama && matchKategori) {
                        card.style.display = '';
                        anyVisible = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                section.style.display = anyVisible ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterProduk);
        filterKategori.addEventListener('change', filterProduk);
    </script>

</body>
</html>
