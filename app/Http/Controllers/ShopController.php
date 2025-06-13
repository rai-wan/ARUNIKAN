<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function showShop()
    {
        $response = Http::withOptions([
            'proxy' => '' 
        ])->timeout(5)->get('http://127.0.0.1:8000/api/produk/');
        

        if ($response->successful()) {
            $json = $response->json();
            $produk = is_array($json) && isset($json['data']) ? $json['data'] : $json;
        } else {
            $produk = []; 
        }

        return view('shop', ['produk' => $produk]);
    }
}
