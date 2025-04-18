<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arunikan - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-gray-200 px-6 py-4 shadow flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="w-8 h-8 bg-black rounded-full"></div>
            <span class="font-bold text-lg">Arunikan</span>
        </div>
        <div class="space-x-8 hidden md:flex">
            <a href="#" class="font-semibold border-b-2 border-black">Home</a>
            <a href="#">Shop</a>
            <a href="#">About</a>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-5 h-5 border border-black rounded-full flex items-center justify-center text-xs">🔍</div>
            <div class="w-8 h-8 border border-black rounded-full"></div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold mb-6">WELCOME TO ARUNIKAN</h1>
        
        <!-- Top section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        
            <img src="{{ asset('images/toko.jpeg') }}" alt="Gambar Ikan" class="w-full h-48 object-cover rounded">
            <div class="bg-gray-200 w-full h-48 rounded p-4">DArunikan adalah platform jual beli ikan hias yang menghubungkan pecinta ikan dengan berbagai jenis ikan berkualitas dari supplier terpercaya. 
Melalui sistem yang mudah digunakan, pelanggan dapat berbelanja secara online maupun langsung di toko fisik. 
Kami berkomitmen menghadirkan pelayanan terbaik, ketersediaan stok yang terjamin, dan pengalaman berbelanja ikan yang menyenangkan.
</div>
        </div>

        <!-- Bottom section -->
        <div class="bg-gray-400 w-full h-48 rounded-lg shadow-md flex items-center justify-center text-gray-700">
            Section Konten Utama Bawah
        </div>
    </main>
</body>
</html>
