<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuplayerController extends Controller
{
    public function index()
    {
        $token = session('token');
        $role = session('role');

        // Hanya izinkan role admin
        if (!$token || $role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        // Ambil daftar produk
        $produkResponse = Http::withToken($token)->get('http://127.0.0.1:8000/api/produk/');
        $produk = $produkResponse->successful() ? $produkResponse->json() : [];

        // Ambil semua data stok masuk
        $stokResponse = Http::withToken($token)->get('http://127.0.0.1:8000/api/stok-masuk/');
        $stokMasuk = $stokResponse->successful() ? $stokResponse->json() : [];

        return view('supplier.gudang', compact('produk', 'stokMasuk'));
    }

    public function simpan(Request $request)
    {
        $token = session('token');
        $role = session('role');

        if (!$token || $role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya admin yang dapat menambahkan stok.');
        }

        $data = [
            'produk' => $request->input('produk_id'),
            'tanggal_masuk' => now()->toDateString(),
            'jumlah' => $request->input('jumlah'),
            'harga_satuan' => $request->input('harga_satuan'),
            'keterangan' => $request->input('keterangan'),
        ];

        $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/stok-masuk/', $data);

        if ($response->successful()) {
            return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil ditambahkan.');
        } else {
            return back()->with('error', 'Gagal menyimpan stok: ' . $response->body());
        }
    }

    public function edit($id)
    {
        $token = session('token');
        $role = session('role');

        if (!$token || $role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya admin yang dapat mengedit data.');
        }

        $stokResponse = Http::withToken($token)->get("http://127.0.0.1:8000/api/stok-masuk/");
        $produkResponse = Http::withToken($token)->get("http://127.0.0.1:8000/api/produk/");

        $stokMasukList = $stokResponse->successful() ? $stokResponse->json() : [];
        $produkList = $produkResponse->successful() ? $produkResponse->json() : [];

        $stok = collect($stokMasukList)->firstWhere('id', $id);

        if (!$stok) {
            return back()->with('error', 'Data stok tidak ditemukan.');
        }

        return view('supplier.edit', [
            'stok' => $stok,
            'produk' => $produkList,
        ]);
    }

    public function update(Request $request, $id)
    {
        $token = session('token');
        $role = session('role');

        if (!$token || $role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya admin yang dapat mengedit data.');
        }

        $data = [
            'produk' => $request->input('produk_id'),
            'jumlah' => $request->input('jumlah'),
            'harga_satuan' => $request->input('harga_satuan'),
            'keterangan' => $request->input('keterangan'),
        ];

        $response = Http::withToken($token)->put("http://127.0.0.1:8000/api/stok-masuk/{$id}/", $data);

        if ($response->successful()) {
            return redirect()->route('admin.stok.index')->with('success', 'Data stok berhasil diperbarui.');
        } else {
            return back()->with('error', 'Gagal update: ' . $response->body());
        }
    }

    public function hapus($id)
    {
        $token = session('token');
        $role = session('role');

        if (!$token || $role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya admin yang dapat menghapus data.');
        }

        $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/stok-masuk/{$id}/");

        if ($response->successful()) {
            return redirect()->route('admin.stok.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return back()->with('error', 'Gagal menghapus data: ' . $response->body());
        }
    }
}
