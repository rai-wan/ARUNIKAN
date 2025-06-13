<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arunikan - Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="text-xl font-bold text-blue-600">Arunikan</div>
        <div class="space-x-4">
            <a href="/index" class="hover:underline text-gray-700">Home</a>
            <a href="/shop" class="hover:underline text-blue-600 font-semibold">Shop</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Produk Kami</h2>

        @if(count($produk) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($produk as $item)
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
                @if($item['gambar'])
                    <img src="{{ $item['gambar'] }}" alt="{{ $item['nama'] }}" class="h-48 w-full object-cover">
                @else
                    <img src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image" class="h-48 w-full object-cover">
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $item['nama'] }}</h3>
                    <p class="text-sm text-gray-600 mb-1">Kategori: {{ $item['kategori']['nama_kategori'] ?? '-' }}</p>
                    @if(isset($item['Promo']))
                        <p class="text-sm text-red-500 mb-1">Promo: {{ $item['Promo']['persen'] }}%</p>
                    @endif
                    <p class="text-xl font-bold text-blue-600 mb-2">Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mb-4">Stok: {{ $item['stok'] }}</p>
                    <div class="flex gap-2">
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded w-1/2 hover:bg-gray-300">Add to Cart</button>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded w-1/2 hover:bg-blue-700">Buy Now</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p class="text-center text-gray-500 mt-10">Tidak ada produk yang tersedia saat ini.</p>
        @endif
    </div>
</body>
</html>
