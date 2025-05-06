<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    public function index()
    {
        return view('komunitas');
    }
}
