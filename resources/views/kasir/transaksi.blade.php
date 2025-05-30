<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kasir - Transaksi | Arunikan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-blue-800 text-white py-4 px-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-bold">Panel Kasir - Transaksi</h1>
      <a href="/dashboard" class="text-sm underline hover:text-blue-200">← Kembali ke Dashboard</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Input Pembelian</h2>

    <!-- Form Pembelian -->
    <form class="bg-white p-6 rounded shadow-md max-w-xl">
      <div class="mb-4">
        <label class="block mb-1 font-medium">Nama Pembeli</label>
        <input type="text" class="w-full border rounded px-4 py-2" placeholder="Masukkan nama pembeli">
      </div>
      <div class="mb-4">
        <label class="block mb-1 font-medium">Jenis Ikan</label>
        <select class="w-full border rounded px-4 py-2">
          <option value="">-- Pilih Ikan --</option>
          <option>Ikan Cupang</option>
          <option>Ikan Koi</option>
          <option>Ikan Guppy</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block mb-1 font-medium">Jumlah</label>
        <input type="number" class="w-full border rounded px-4 py-2" placeholder="1">
      </div>
      <div class="mb-4">
        <label class="block mb-1 font-medium">Total Harga</label>
        <input type="text" class="w-full border rounded px-4 py-2" placeholder="Rp">
      </div>
      <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Transaksi</button>
    </form>

    <!-- Riwayat Transaksi -->
    <div class="mt-10">
      <h2 class="text-xl font-semibold mb-4 text-gray-700">Riwayat Transaksi</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
          <thead>
            <tr class="bg-blue-100 text-left text-sm text-blue-800">
              <th class="py-3 px-4">Nama</th>
              <th class="py-3 px-4">Ikan</th>
              <th class="py-3 px-4">Jumlah</th>
              <th class="py-3 px-4">Total</th>
              <th class="py-3 px-4">Waktu</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t">
              <td class="py-3 px-4">Andi</td>
              <td class="py-3 px-4">Ikan Cupang</td>
              <td class="py-3 px-4">2</td>
              <td class="py-3 px-4">Rp50.000</td>
              <td class="py-3 px-4">2025-05-15 10:30</td>
            </tr>
            <!-- Data dummy lainnya -->
          </tbody>
        </table>
      </div>
    </div>
  </main>

</body>
</html>

