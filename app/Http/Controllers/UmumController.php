<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UmumController extends Controller
{
    public function dashboard()
    {
        return view('dashboard'); // file: resources/views/dashboard.blade.php
    }

    public function riwayat()
    {
        $token = session('token');
        $username = session('username');

        try {
            $response = Http::withToken($token)->get(env('API_BASE_URL') . '/shop-transaksi/');
            $all = $response->successful() ? $response->json() : [];

            // Ambil hanya yang nama_pembeli-nya sama dengan yang login
            $riwayat = array_filter($all, function ($trx) use ($username) {
                return strtolower($trx['nama_pembeli']) === strtolower($username);
            });

            return view('riwayat', ['riwayat' => array_reverse($riwayat)]);
        } catch (\Exception $e) {
            return view('riwayat', ['riwayat' => [], 'error' => 'Gagal mengambil data.']);
        }
    }

}
