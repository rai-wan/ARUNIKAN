<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gudang - Supplier | Arunikan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-blue-800 text-white py-4 px-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-bold">Panel Supplier - Gudang</h1>
      <a href="/dashboard" class="text-sm underline hover:text-blue-200">← Kembali ke Dashboard</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Stok Ikan Tersedia</h2>

    <!-- Tabel stok ikan -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded shadow">
        <thead>
          <tr class="bg-blue-100 text-left text-sm text-blue-800">
            <th class="py-3 px-4">Nama Ikan</th>
            <th class="py-3 px-4">Jenis</th>
            <th class="py-3 px-4">Stok</th>
            <th class="py-3 px-4">Harga</th>
            <th class="py-3 px-4">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh data dummy -->
          <tr class="border-t">
            <td class="py-3 px-4">Ikan Cupang</td>
            <td class="py-3 px-4">Air Tawar</td>
            <td class="py-3 px-4">120</td>
            <td class="py-3 px-4">Rp25.000</td>
            <td class="py-3 px-4">
              <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 text-sm rounded">Edit</button>
              <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 text-sm rounded">Hapus</button>
            </td>
          </tr>
          <!-- Tambahkan baris lainnya -->
        </tbody>
      </table>
    </div>

    <!-- Tombol tambah stok -->
    <div class="mt-6">
      <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">+ Tambah Stok Baru</a>
    </div>
  </main>

</body>
</html>

