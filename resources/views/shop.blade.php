<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arunikan - Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Pakai Tailwind dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    {{-- Navbar --}}
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="text-xl font-bold text-blue-600">Arunikan</div>
        <div class="space-x-4">
            <a href="/" class="hover:underline text-gray-700">Home</a>
            <a href="/shop" class="hover:underline text-blue-600 font-semibold">Shop</a>
            <a href="/about" class="hover:underline text-gray-700">About</a>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <div class="container mx-auto mt-10 p-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Best Seller Fishes</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="h-40 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">[ Gambar Ikan ]</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Betta Fish (Male & Female)</h3>
                    <div class="text-yellow-500 text-sm mb-2">⭐ 4.9 (1.4k Reviews)</div>
                    <p class="text-xl font-bold text-blue-600 mb-4">Rp172.999</p>
                    <div class="flex gap-2">
                        <button class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 w-1/2">Add to Cart</button>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-1/2">Buy Now</button>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>

</body>
</html>
