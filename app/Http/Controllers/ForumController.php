<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function index()
    {
        return view('forum');
    }
}
