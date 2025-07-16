<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Arunikan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    {{-- 🔴 Notifikasi jika bukan kasir --}}
    @if(session('role_error'))
        <div id="notif-role" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded shadow-lg z-50">
            {{ session('role_error') }}
        </div>
        <script>
            document.addEventListener('click', function () {
                const notif = document.getElementById('notif-role');
                if (notif) notif.style.display = 'none';
            });
        </script>
    @endif

<!-- Navbar -->
<nav class="sticky top-0 bg-white shadow z-50">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <a href="/dashboard" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
            <span class="text-2xl font-bold text-blue-600">Arunikan</span>
        </a>

        <div class="space-x-6 hidden md:flex items-center">
            <a href="#kategori" class="hover:text-blue-600">Kategori</a>
            <a href="#testimoni" class="hover:text-blue-600">Testimoni</a>
            <a href="#tips" class="hover:text-blue-600">Tips</a>
            <a href="/shop" class="hover:text-blue-600">Shop</a>
            <a href="/index" class="hover:text-blue-600">Home</a>

            <!-- Profile Dropdown -->
            <div class="relative" id="profile-dropdown-wrapper">
                <button onclick="toggleDropdown()" class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center focus:outline-none">
                    <span class="font-semibold uppercase">{{ strtoupper(substr(session('username'), 0, 1) ?? 'U') }}</span>
                </button>

                <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden z-50">
                    
                    <a href="{{ route('shop.riwayat') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Riwayat Transaksi</a>

                    <!-- Tombol logout menggunakan form POST -->
                    <a href="{{ route('logout') }}"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="bg-blue-100 py-20 text-center">
    <h1 class="text-4xl font-extrabold mb-4">Selamat Datang di Arunikan</h1>
    <p class="text-lg mb-6">Marketplace ikan hias terlengkap dan terpercaya</p>
    <a href="/shop" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700">Belanja Sekarang</a>
</section>

<!-- Kategori Produk -->
<section id="kategori" class="py-16 px-6 bg-gray-100">
    <h2 class="text-2xl font-semibold text-center mb-10">Kategori Produk</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-bold text-lg mb-2">Ikan Hias</h3>
            <p>Ikan air tawar dan laut dari berbagai jenis & warna.</p>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-bold text-lg mb-2">Aksesoris Akuarium</h3>
            <p>Filter, tanaman, dekorasi dan lampu akuarium.</p>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-bold text-lg mb-2">Pakan Ikan</h3>
            <p>Pakan berkualitas tinggi untuk semua jenis ikan.</p>
        </div>
    </div>
</section>

<!-- Testimoni -->
<section id="testimoni" class="py-16 px-6">
    <h2 class="text-2xl font-semibold text-center mb-10">Apa Kata Mereka</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <div class="bg-white shadow p-6 rounded">
            <p>"Pelayanannya cepat, ikannya sehat semua!"</p>
            <span class="text-sm text-blue-600">— Sari, Jakarta</span>
        </div>
        <div class="bg-white shadow p-6 rounded">
            <p>"Sistem belanjanya mudah, stok selalu update."</p>
            <span class="text-sm text-blue-600">— Budi, Bandung</span>
        </div>
        <div class="bg-white shadow p-6 rounded">
            <p>"Suppliernya responsif dan profesional."</p>
            <span class="text-sm text-blue-600">— Tono, Surabaya</span>
        </div>
    </div>
</section>

<!-- Tips / Artikel -->
<section id="tips" class="py-16 px-6 bg-gray-100">
    <h2 class="text-2xl font-semibold text-center mb-10">Tips Merawat Ikan</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-2">Cara Memelihara Ikan Cupang</h3>
            <p class="text-sm text-gray-600">Pelajari cara merawat ikan cupang agar warnanya tetap cerah.</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-2">Filter Akuarium yang Tepat</h3>
            <p class="text-sm text-gray-600">Jenis filter yang cocok untuk ikan hias tropis.</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-2">Makanan Ikan Bernutrisi</h3>
            <p class="text-sm text-gray-600">Rekomendasi pakan ikan terbaik dari para ahli.</p>
        </div>
    </div>
</section>

<!-- Call to Action Role -->
<section class="py-16 px-6">
    <h2 class="text-2xl font-semibold text-center mb-10">Masuk Sebagai</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
        <a href="/admin/dashboard" class="text-center p-6 bg-white rounded shadow hover:bg-blue-50">
            <h3 class="font-bold">Admin</h3>
            <p class="text-sm text-gray-600">Kelola seluruh sistem.</p>
        </a>
        <a href="/kasir" class="text-center p-6 bg-white rounded shadow hover:bg-blue-50">
            <h3 class="font-bold">Kasir</h3>
            <p class="text-sm text-gray-600">Transaksi toko langsung.</p>
        </a>
        <a href="/shop" class="text-center p-6 bg-white rounded shadow hover:bg-blue-50">
            <h3 class="font-bold">Pembeli</h3>
            <p class="text-sm text-gray-600">Belanja ikan hias online.</p>
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white border-t mt-10 py-6 text-center text-sm text-gray-500">
    &copy; 2025 Arunikan. All rights reserved.
</footer>

<!-- Dropdown Script -->
<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdown-menu');
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        const wrapper = document.getElementById('profile-dropdown-wrapper');
        const menu = document.getElementById('dropdown-menu');
        if (!wrapper.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>

</body>
</html>
