<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KasirController extends Controller
{
    public function showTransaksi()
    {
        // NONAKTIFKAN PROXY UNTUK PRODUK
        $produkResponse = Http::withoutVerifying()->withOptions([
            'proxy' => '',
        ])->get('http://127.0.0.1:8000/api/produk/');

        $produk = $produkResponse->successful() ? $produkResponse->json() : [];

        // NONAKTIFKAN PROXY UNTUK PEMBAYARAN
        $pembayaranResponse = Http::withOptions([
            'proxy' => '',
        ])->get('http://127.0.0.1:8000/api/pembayaran/');

        $pembayaran = $pembayaranResponse->successful() ? $pembayaranResponse->json() : [];

        // NONAKTIFKAN PROXY UNTUK TRANSAKSI
        $transaksiResponse = Http::withOptions([
            'proxy' => '',
        ])->get('http://127.0.0.1:8000/api/transaksi/');

        $transaksi = $transaksiResponse->successful() ? $transaksiResponse->json() : [];

        return view('kasir.transaksi', [
            'produk' => $produk,
            'pembayaran' => $pembayaran,
            'transaksi' => $transaksi,
        ]);
    }
}
