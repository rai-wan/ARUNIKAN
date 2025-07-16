<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Arunikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-slate-700">
            Arunikan Admin
        </div>
        <nav class="flex-1 p-4 space-y-4">
            <a href="/admin/dashboard" class="block hover:bg-slate-700 px-3 py-2 rounded">Dashboard</a>
            <a href="/admin/register-akun" class="block hover:bg-slate-700 px-3 py-2 rounded">Daftarkan Akun</a>
            <a href="{{ route('admin.produk') }}" class="block hover:bg-slate-700 px-3 py-2 rounded">Kelola Produk</a>
            <a href="{{ route('admin.stok.index') }}" class="block hover:bg-slate-700 px-3 py-2 rounded">Stok Masuk</a>
            <a href="{{ route('rekap.index') }}" class="block hover:bg-slate-700 px-3 py-2 rounded">Rekap Penjualan</a>
            <a href="{{ route('admin.verifikasi_pembayaran') }}" class="block hover:bg-slate-700 px-3 py-2 rounded">Verifikasi Pembayaran</a>
        </nav>
        <div class="p-4 border-t border-slate-700">
            <a href="/dashboard" class="block text-red-400 hover:underline">Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-slate-700">Dashboard Admin</h1>
            <span class="text-gray-500">Halo, Admin</span>
        </header>

        <!-- Content -->
        <main class="p-6 overflow-y-auto">
            <h2 class="text-2xl font-bold text-slate-700 mb-6">Statistik</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 rounded-full text-blue-700">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah User</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ is_array($user) ? count($user) : 0 }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-green-100 rounded-full text-green-700">
                            <i class="fas fa-box fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Produk</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ is_array($produk) ? count($produk) : 0 }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-pink-100 rounded-full text-pink-700">
                            <i class="fas fa-gift fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Promo</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ is_array($promo) ? count($promo) : 0 }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-yellow-100 rounded-full text-yellow-700">
                            <i class="fas fa-cash-register fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Transaksi Kasir</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ is_array($transaksi) ? count($transaksi) : 0 }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-indigo-100 rounded-full text-indigo-700">
                            <i class="fas fa-store fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Transaksi dari Shop</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ is_array($shop) ? count($shop) : 0 }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-red-100 rounded-full text-red-700">
                            <i class="fas fa-truck-loading fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tagihan Produk Supplier</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ is_array($stokMasuk) ? count($stokMasuk) : 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>
