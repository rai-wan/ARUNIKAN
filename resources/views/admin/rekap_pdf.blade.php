<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Penjualan - PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 15px;
        }
        table th, table td {
            border: 1px solid #444;
            padding: 5px;
            text-align: left;
        }
        .section-title {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Rekapitulasi Penjualan</h2>

    {{-- Penjualan Shop --}}
    <p class="section-title">Penjualan Shop</p>
    <table>
        <thead>
            <tr>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $item)
                @if (str_contains(strtolower($item['tipe']), 'shop'))
                    <tr>
                        <td>{{ $item['nama_pembeli'] ?? '-' }}</td>
                        <td>
                            @if (is_array($item['produk']))
                                {{ $item['produk']['nama'] ?? '-' }}
                            @else
                                Produk #{{ $item['produk'] }}
                            @endif
                        </td>
                        <td>{{ $item['jumlah'] ?? '-' }}</td>
                        <td>Rp{{ number_format($item['total'] ?? $item['total_harga'] ?? 0) }}</td>
                        <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    {{-- Transaksi Kasir --}}
    <p class="section-title">Transaksi Kasir</p>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Konsumen</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t['tanggal'])->format('d M Y') }}</td>
                    <td>{{ $t['konsumen']['username'] ?? '-' }}</td>
                    <td>{{ $t['kasir']['username'] ?? '-' }}</td>
                    <td>Rp{{ number_format($t['total'] ?? 0) }}</td>
                    <td>{{ $t['jenis_payment']['nama_pembayaran'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Stok Masuk --}}
    <p class="section-title">Stok Masuk</p>
    <table>
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stokMasuk as $s)
                <tr>
                    <td>{{ $s['nama_suplayer'] ?? '-' }}</td>
                    <td>{{ $s['nama_produk'] ?? '-' }}</td>
                    <td>{{ $s['jumlah'] ?? '-' }}</td>
                    <td>Rp{{ number_format($s['harga_satuan'] ?? 0) }}</td>
                    <td>Rp{{ number_format($s['subtotal'] ?? 0) }}</td>
                    <td>{{ \Carbon\Carbon::parse($s['tanggal_masuk'])->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
