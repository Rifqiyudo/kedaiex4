<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
     public function index()
    {
        $ulasan = Ulasan::with([
            'user', 
            'order.orderItems.product' 
        ])->latest()->take(12)->get(); 

        return view('welcome', compact('ulasan'));
    }
}
