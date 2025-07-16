<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $response = Http::withOptions([
                'proxy' => null,
                'curl' => [CURLOPT_PROXY => ''],
            ])->post('http://127.0.0.1:8000/api/account/login/', [
                'username' => $request->username,
                'password' => $request->password,
                'actor' => $request->actor, // sesuai field yang dikirim frontend
            ]);
    
            if ($response->successful()) {
                $data = $response->json();
    
                session([
                    'token' => $data['access'] ?? null,
                    'refresh_token' => $data['refresh'] ?? null,
                    'role' => $data['role'] ?? null,
                    'user_id' => $data['id'] ?? null,
                    'username' => $data['username'] ?? null,
                ]);
    
                return redirect('/dashboard');
            } else {
                return back()->with('error', 'Login gagal. Username atau password salah.');
            }
    
        } catch (\Exception $e) {
            // Tampilkan error untuk debug
            return back()->with('error', 'Tidak dapat terhubung ke server backend. ' . $e->getMessage());
        }
    }
    
}
