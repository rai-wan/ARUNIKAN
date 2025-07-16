<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $token = session('token'); // Pastikan token disimpan saat login

        try {
            $response = Http::withToken($token)
                ->get('http://127.0.0.1:8000/api/produk/');

            if (!$response->successful()) {
                return view('shop', [
                    'error' => 'Gagal mengambil data produk.',
                    'kategori_terbagi' => [],
                    'kategori_list' => [],
                ]);
            }

            $produk = $response->json();

            // Kelompokkan berdasarkan kategori
            $kategori_terbagi = [];
            $kategori_list = [];

            foreach ($produk as $item) {
                $kategori = $item['kategori']['nama'] ?? 'Tanpa Kategori';

                if (!isset($kategori_terbagi[$kategori])) {
                    $kategori_terbagi[$kategori] = [];
                    $kategori_list[] = $kategori;
                }

                $kategori_terbagi[$kategori][] = $item;
            }

            return view('shop', compact('kategori_terbagi', 'kategori_list'));
        } catch (\Exception $e) {
            return view('shop', [
                'error' => 'Gagal mengambil data produk.',
                'kategori_terbagi' => [],
                'kategori_list' => [],
            ]);
        }
    }
}
