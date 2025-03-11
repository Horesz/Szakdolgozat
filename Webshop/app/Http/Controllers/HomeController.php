<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use App\Models\Category;




class HomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $categories = Category::all(); // Lekérdezi az összes kategóriát
        // Kiemelt termékek lekérése az adatbázisból
        $featuredProducts = Product::where('is_featured', 1)->take(8)->get(); 


        return view('welcome', compact('product','categories','featuredProducts'))->with('success', 'Adatok betöltve');

    }
}