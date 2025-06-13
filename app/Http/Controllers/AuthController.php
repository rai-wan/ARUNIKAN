<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/account/login/', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Simpan token ke session
            session([
                'access_token' => $data['access'],
                'refresh_token' => $data['refresh'],
                'actor' => $request->actor,
            ]);

            return redirect('/dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'Login gagal. Periksa kembali username/password.');
        }
    }
}
