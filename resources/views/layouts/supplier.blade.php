<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Supplier Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md px-6 py-4 mb-6">
        <div class="flex justify-between items-center">
            <div class="text-xl font-bold text-green-600">🧺 Supplier Panel</div>
            <div class="space-x-4">
                <a href="/supplier" class="text-gray-700 hover:text-green-600">Dashboard</a>
                <a href="/supplier/tambah" class="text-gray-700 hover:text-green-600">Tambah Produk</a>
                <a href="/logout" class="text-red-600 hover:text-red-800">Logout</a>
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-sm text-gray-500 mt-10 py-4">
        &copy; {{ date('Y') }} Arunikan. All rights reserved.
    </footer>

</body>
</html>
