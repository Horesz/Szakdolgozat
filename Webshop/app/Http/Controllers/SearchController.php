<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    /**
     * Termékek keresése
     */
    public function search(Request $request)
    {
        try {
            // Keresési kifejezés lekérése
            $searchTerm = $request->input('q');
            
            // Ha nincs keresési kifejezés, átirányítás a termékek böngészőjére
            if (empty($searchTerm)) {
                return redirect()->route('products.browse')
                    ->with('warning', 'Kérem adjon meg egy keresési kifejezést');
            }
            
            // Keresés termékek között
            $query = Product::where('status', 'Aktív')
                ->where(function($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('brand', 'like', "%{$searchTerm}%")
                      ->orWhere('short_description', 'like', "%{$searchTerm}%")
                      ->orWhere('full_description', 'like', "%{$searchTerm}%")
                      // Kategória név szerinti keresés is
                      ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                          $categoryQuery->where('name', 'like', "%{$searchTerm}%");
                      });
                });
            
            // Rendezés alapértelmezetten a legújabb termékek szerint
            $query->orderBy('created_at', 'desc');
            
            // Lapozás
            $products = $query->paginate(12)->withQueryString();
            
            // Kategóriák lekérése a szűrőkhöz
            $categories = Category::where('status', 'active')->get();
            
            // SEO információk
            $title = "Keresési eredmények: \"{$searchTerm}\"";
            $description = "Keresési eredmények a(z) \"{$searchTerm}\" kifejezésre a GamerShop webáruházban.";
            
            // Log a keresésről
            Log::info('Sikeres keresés', [
                'search_term' => $searchTerm,
                'total_results' => $products->total()
            ]);
            
            // Visszatérés a termékek böngészője view-val
            return view('layouts.admin.products.browse', compact(
                'products', 
                'categories', 
                'searchTerm',
                'title',
                'description'
            ));
        } catch (\Exception $e) {
            // Hibák naplózása
            Log::error('Hiba a keresés során', [
                'error' => $e->getMessage(),
                'search_term' => $request->input('q')
            ]);
            
            // Visszairányítás hibaüzenettel
            return redirect()->route('products.browse')
                ->with('error', 'Hiba történt a keresés során. Kérjük, próbálja újra.');
        }
    }
}