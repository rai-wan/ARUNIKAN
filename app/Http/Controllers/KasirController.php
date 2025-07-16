<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KasirController extends Controller
{
    public function form(Request $request)
    {
        $role = strtolower(session('role')); // gunakan lowercase untuk konsistensi

        $token = session('token');
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        try {
            $produk = Http::withHeaders($headers)->get(env('API_BASE_URL') . '/produk/');
            $pembayaran = Http::withHeaders($headers)->get(env('API_BASE_URL') . '/pembayaran/');
        } catch (\Exception $e) {
            return response()->view('error', [
                'message' => 'Gagal konek ke server Django: ' . $e->getMessage()
            ]);
        }

        return view('kasir.transaksi', [
            'produk' => $produk->successful() ? $produk->json() : [],
            'pembayaran' => $pembayaran->successful() ? $pembayaran->json() : [],
            'produk_terpilih' => $request->produk_id,
            'jumlah_default' => $request->jumlah ?? 1,
            'bukan_kasir' => $role !== 'kasir', // dikirim ke blade
        ]);
    }

    public function simpan(Request $request)
    {
        $token = session('token');

        $data = [
            'tanggal' => now()->toDateString(),
            'konsumen' => $request->input('nama_konsumen'),
            'kasir' => session('user_id'),
            'total' => $request->input('total'),
            'jenis_payment' => $request->input('jenis_payment'),
            'detail' => [
                [
                    'produk' => $request->input('produk'),
                    'jumlah' => $request->input('jumlah'),
                    'total' => $request->input('total'),
                ]
            ]
        ];

        $response = Http::withToken($token)
            ->post(env('API_BASE_URL') . '/kasir/transaksi/', $data);

        if ($response->successful()) {
            return redirect('/kasir')->with('success', 'Transaksi berhasil disimpan.');
        } else {
            return redirect('/kasir')->with('error', 'Gagal menyimpan transaksi.');
        }
    }
}
