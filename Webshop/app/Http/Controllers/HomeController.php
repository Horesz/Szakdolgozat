<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        
        // Kiemelt termékek lekérése az adatbázisból
        $featuredProducts = Product::where('is_featured', 1)->take(8)->get(); 
        
        // Legújabb termékek lekérése
        $newArrivals = Product::where('is_new_arrival', true)
            ->where('status', 'Aktív')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
            
        // Aktív kategóriák lekérése
        $categories = Category::where('status', 'active')->get();
        
        // Kategóriákhoz kép társítása
        foreach ($categories as $category) {
            // Ha már van kép az adatbázisban, azt használjuk
            if ($category->image) {
                continue;
            }
            
            // Ha nincs kép az adatbázisban, megpróbálunk találni a fájlrendszerben
            $slug = Str::slug($category->name);
            $possibleImages = [
                $slug . '.png',
                strtolower(str_replace(' ', '', $category->name)) . '.png',
                strtolower($category->name) . '.png'
            ];
            
            $imageFound = false;
            foreach ($possibleImages as $imgName) {
                $imagePath = 'images/categories/' . $imgName;
                if (File::exists(public_path($imagePath))) {
                    $category->image_path = $imagePath;
                    $imageFound = true;
                    break;
                }
            }
            
            // Képcsere speciális esetekre
            if (!$imageFound) {
                // Példa néhány speciális esetre
                switch (strtolower($category->name)) {
                    case 'konzol':
                        $category->image_path = 'images/categories/consoles.png';
                        break;
                    case 'számítógép':
                        $category->image_path = 'images/categories/pc.png';
                        break;
                    case 'játékszoftver':
                        $category->image_path = 'images/categories/games.png';
                        break;
                    case 'perifériák':
                        $category->image_path = 'images/categories/peripherals.png';
                        break;
                    default:
                        $category->image_path = 'images/categories/default.png';
                }
            }
        }

        return view('welcome', compact('product', 'categories', 'featuredProducts', 'newArrivals'))
               ->with('success', 'Adatok betöltve');
    }
}