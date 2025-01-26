<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Összes termék listázása
    public function index(Request $request)
    {
        // Alapértelmezett szűrési és rendezési lehetőségek
        $query = Product::query();

        // Kategória szerinti szűrés
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        // Típus szerinti szűrés
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        // Ár szerinti rendezés
        if ($request->has('sort')) {
            switch($request->input('sort')) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $query->paginate(12);

        $categories = Category::all();
        $types = Product::distinct('type')->pluck('type');

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'types' => $types
        ]);
    }

    // Egyedi termék megjelenítése
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        // Kapcsolódó termékek (pl. ugyanabból a kategóriából)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }

    // Termék létrehozása (admin funkció)
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Termék mentése
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:products|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'type' => 'required|in:Konzol,Számítógép,Laptop,Perifériák,Játékszoftver,Kiegészítők',
            'brand' => 'required|max:100',
            'specifications' => 'nullable|json',
            'tags' => 'nullable|json',
            'short_description' => 'required',
            'full_description' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        // Képfeltöltés kezelése
        $imageUrls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imageUrls[] = Storage::url($path);
            }
        }

        // Termék létrehozása
        $product = Product::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
            'stock_quantity' => $validatedData['stock_quantity'],
            'type' => $validatedData['type'],
            'brand' => $validatedData['brand'],
            'short_description' => $validatedData['short_description'],
            'full_description' => $validatedData['full_description'],
            'images' => $imageUrls,
            'specifications' => $request->input('specifications', []),
            'tags' => $request->input('tags', [])
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Termék sikeresen létrehozva');
    }

    // Termék szerkesztése
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    // Termék frissítése
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            // Hasonló validációs szabályok, mint a store metódusban

        ]);

        $product->update($validatedData);

        return redirect()->route('admin.products.index')
            ->with('success', 'Termék sikeresen frissítve');
    }

    // Termék törlése
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Termék sikeresen törölve');
    }

    // Termékek keresése
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('brand', 'LIKE', "%{$query}%")
            ->orWhere('short_description', 'LIKE', "%{$query}%")
            ->paginate(12);

        return view('products.search', [
            'products' => $products,
            'query' => $query
        ]);
    }
}