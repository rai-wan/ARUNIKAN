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
  <main class="p-6 max-w-6xl mx-auto">
    <!-- Form Input Transaksi -->
    <section class="bg-white p-6 rounded shadow-md mb-10">
      <h2 class="text-xl font-semibold mb-4 text-gray-700">Input Transaksi</h2>
      <form id="formTransaksi" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block mb-1 font-medium">Nama Konsumen</label>
          <input type="text" name="konsumen" class="w-full border rounded px-4 py-2" placeholder="Masukkan nama">
        </div>
        <div>
          <label class="block mb-1 font-medium">Produk</label>
          <select name="produk" class="w-full border rounded px-4 py-2">
            @foreach($produk as $p)
              <option value="{{ $p['id'] }}">{{ $p['nama'] }} - Rp{{ number_format($p['harga'],0,',','.') }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block mb-1 font-medium">Jumlah</label>
          <input type="number" name="jumlah" class="w-full border rounded px-4 py-2" placeholder="1" min="1">
        </div>
        <div>
          <label class="block mb-1 font-medium">Metode Pembayaran</label>
          <select name="pembayaran" class="w-full border rounded px-4 py-2">
            @foreach($pembayaran as $metode)
              <option value="{{ $metode['id'] }}">{{ $metode['nama_pembayaran'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="md:col-span-2">
          <label class="block mb-1 font-medium">Total Harga</label>
          <input type="text" name="total" class="w-full border rounded px-4 py-2" readonly placeholder="Rp0">
        </div>
        <div class="md:col-span-2 text-right">
          <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Transaksi</button>
        </div>
      </form>
    </section>

    <!-- Riwayat Transaksi -->
    <section>
      <h2 class="text-xl font-semibold mb-4 text-gray-700">Riwayat Transaksi</h2>
      <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm">
          <thead class="bg-blue-100 text-blue-800">
            <tr>
              <th class="py-3 px-4 text-left">Nama</th>
              <th class="py-3 px-4 text-left">Produk</th>
              <th class="py-3 px-4 text-left">Jumlah</th>
              <th class="py-3 px-4 text-left">Total</th>
              <th class="py-3 px-4 text-left">Pembayaran</th>
              <th class="py-3 px-4 text-left">Waktu</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transaksi as $t)
              <tr class="border-t">
                <td class="py-2 px-4">{{ $t['konsumen']['username'] ?? '-' }}</td>
                <td class="py-2 px-4">{{ $t['produk']['nama'] ?? '-' }}</td>
                <td class="py-2 px-4">{{ $t['jumlah'] }}</td>
                <td class="py-2 px-4">Rp{{ number_format($t['total'], 0, ',', '.') }}</td>
                <td class="py-2 px-4">{{ $t['jenis_payment']['nama_pembayaran'] ?? '-' }}</td>
                <td class="py-2 px-4">{{ $t['tanggal'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>

</body>
</html>
