<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopTransaksiController extends Controller
{
    public function form(Request $request)
    {
        $token = session('token');

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        try {
            // Ambil data produk berdasarkan ID
            $produk = Http::withHeaders($headers)
                ->get(env('API_BASE_URL') . '/produk/' . $request->produk_id . '/');

            if (!$produk->successful()) {
                throw new \Exception("Gagal ambil data produk");
            }

            // Ambil data metode pembayaran
            $pembayaran = Http::withHeaders($headers)
                ->get(env('API_BASE_URL') . '/pembayaran/');

            if (!$pembayaran->successful()) {
                throw new \Exception("Gagal ambil metode pembayaran");
            }

            return view('shop.transaksi_shop', [
                'produk' => $produk->json(),
                'jumlah' => $request->jumlah ?? 1,
                'pembayaranList' => $pembayaran->json(),
            ]);
        } catch (\Exception $e) {
            return response()->view('error', [
                'message' => 'Gagal konek ke API atau ambil data: ' . $e->getMessage(),
            ]);
        }
    }

    public function simpan(Request $request)
    {
        $token = session('token');

        $data = [
            'produk' => $request->input('produk_id'),
            'nama_pembeli' => $request->input('nama_pembeli'),
            'jumlah' => $request->input('jumlah'),
            'total_harga' => $request->input('total_harga'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'lokasi_pengantaran' => $request->input('lokasi_pengantaran'),
            'status_pembayaran' => 'pending',
        ];

        try {
            $response = Http::withToken($token)
                ->asMultipart()
                ->attach(
                    'bukti_transfer',
                    $request->file('bukti_transfer')->get(),
                    $request->file('bukti_transfer')->getClientOriginalName()
                )
                ->post(env('API_BASE_URL') . '/shop-transaksi/', $data);

            if ($response->successful()) {
                $nota = $response->json();
                $produkId = $nota['produk'];

                // Ambil detail produk dari ID
                $produkResponse = Http::withToken($token)->get(env('API_BASE_URL') . "/produk/{$produkId}/");
                $produk = $produkResponse->successful() ? $produkResponse->json() : null;

                return view('shop.nota', [
                    'nota' => $nota,
                    'produk' => $produk,
                ]);
            } else {
                return back()->with('error', 'Gagal menyimpan transaksi.')->withInput();
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi.')->withInput();
        }
    }

    public function riwayatUser() 
    {
        $token = session('token');
        $username = session('username');

        try {
            $response = Http::withToken($token)->get(env('API_BASE_URL') . '/shop-transaksi/');
            $all = $response->successful() ? $response->json() : [];

            // Filter transaksi milik user saat ini
            $riwayat = array_filter($all, function ($trx) use ($username) {
                return strtolower($trx['nama_pembeli']) === strtolower($username);
            });

            // Ambil nama dan gambar produk untuk setiap transaksi
            foreach ($riwayat as &$item) {
                $produkResp = Http::withToken($token)
                    ->get(env('API_BASE_URL') . '/produk/' . $item['produk'] . '/');

                if ($produkResp->successful()) {
                    $produk = $produkResp->json();
                    $item['nama_produk'] = $produk['nama'] ?? 'Produk #' . $item['produk'];
                    $item['gambar_produk'] = $produk['gambar'] ?? null;
                } else {
                    $item['nama_produk'] = 'Produk #' . $item['produk'];
                    $item['gambar_produk'] = null;
                }
            }

            return view('shop.riwayat', [
                'riwayat' => array_reverse($riwayat) // terbaru di atas
            ]);

        } catch (\Exception $e) {
            return view('shop.riwayat', [
                'riwayat' => [],
                'error' => 'Gagal ambil data transaksi: ' . $e->getMessage()
            ]);
        }
    }

}
