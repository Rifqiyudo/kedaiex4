<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('pelanggan.beranda');
    }
}
