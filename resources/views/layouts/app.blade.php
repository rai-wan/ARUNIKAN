<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arunikan - Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN (jika tidak pakai vite/npm) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar sederhana -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="text-xl font-bold text-blue-600">Arunikan</div>
        <div class="space-x-4">
            <a href="/" class="text-gray-700 hover:underline">Home</a>
            <a href="/shop" class="text-blue-600 font-semibold">Shop</a>
            <a href="/about" class="text-gray-700 hover:underline">About</a>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Best Seller Ikan Hias</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
                    <div class="bg-gray-300 h-40 rounded mb-4"></div>
                    <h2 class="text-lg font-semibold mb-2">Betta Fish</h2>
                    <p class="text-yellow-500 text-sm mb-2">⭐ 4.9 (1.4k Reviews)</p>
                    <p class="text-xl font-bold text-blue-600 mb-4">Rp172.999</p>
                    <div class="flex gap-2">
                        <button class="w-1/2 bg-gray-200 py-2 rounded hover:bg-gray-300">Cart</button>
                        <button class="w-1/2 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Buy</button>
                    </div>
                </div>
            @endfor
        </div>
    </div>

</body>
</html>
