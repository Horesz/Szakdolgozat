<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Kiemelt termékek lekérése az adatbázisból
        $featuredProducts = Product::where('featured', true)
            ->take(8)
            ->get();

        return view('welcome', [
            'featuredProducts' => $featuredProducts
        ]);
    }
}