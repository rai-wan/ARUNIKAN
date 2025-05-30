<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Arunikan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</head>
<body class="bg-blue-50 font-sans">
  <!-- Header -->
  <header class="bg-white shadow-sm py-4 sticky top-0 z-50">
    <div class="container mx-auto px-6 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <img src="/assets/logo.png" alt="Logo" class="h-10 w-10">
        <span class="text-blue-700 font-bold text-xl">Arunikan</span>
      </div>
      <nav class="flex items-center space-x-6">
        <a href="/" class="text-gray-700 hover:text-blue-600">Home</a>
        <a href="/shop" class="text-gray-700 hover:text-blue-600">Shop</a>
        <a href="/about" class="text-gray-700 hover:text-blue-600">About</a>
      </nav>
    </div>
  </header>

  <!-- Slider Promo Ikan -->
  <section class="container mx-auto px-6 py-10">
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="/assets/promo1.jpg" class="rounded-lg w-full h-64 object-cover"></div>
        <div class="swiper-slide"><img src="/assets/promo2.jpg" class="rounded-lg w-full h-64 object-cover"></div>
        <div class="swiper-slide"><img src="/assets/promo3.jpg" class="rounded-lg w-full h-64 object-cover"></div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <script>
    const swiper = new Swiper('.swiper', {
      loop: true,
      pagination: { el: '.swiper-pagination' },
      autoplay: { delay: 3000 },
    });
  </script>

  <!-- Pilihan Role -->
  <section class="container mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-10">Masuk Sebagai</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <a href="/admin/gudang" class="bg-white p-6 shadow rounded-lg text-center hover:bg-blue-100">
        <h3 class="font-bold text-lg">Admin</h3>
        <p class="text-gray-600 text-sm">Kelola seluruh pengguna, produk, pesanan dan laporan.</p>
      </a>
      <a href="/supplier/stok" class="bg-white p-6 shadow rounded-lg text-center hover:bg-blue-100">
        <h3 class="font-bold text-lg">Supplier</h3>
        <p class="text-gray-600 text-sm">Update data stok ikan dan distribusi gudang.</p>
      </a>
      <a href="/kasir/transaksi" class="bg-white p-6 shadow rounded-lg text-center hover:bg-blue-100">
        <h3 class="font-bold text-lg">Kasir</h3>
        <p class="text-gray-600 text-sm">Input data pembelian dan transaksi offline.</p>
      </a>
      <a href="/shop" class="bg-white p-6 shadow rounded-lg text-center hover:bg-blue-100">
        <h3 class="font-bold text-lg">Pembeli</h3>
        <p class="text-gray-600 text-sm">Akses halaman belanja ikan hias online.</p>
      </a>
    </div>
  </section>

  <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
    &copy; 2025 Arunikan. All rights reserved.
  </footer>
</body>
</html>