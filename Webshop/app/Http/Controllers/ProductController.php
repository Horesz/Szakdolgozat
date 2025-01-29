<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Termékek listázása (Admin)
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('layouts.admin.products.index', compact('products'));
    }

    /**
     * Új termék létrehozásának űrlapja
     */
    public function create()
    {
        $categories = Category::all();
        return view('layouts.admin.products.create', compact('categories'));
    }

    /**
     * Új termék mentése
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:products|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'type' => 'required|in:Konzol,Számítógép,Laptop,Perifériák,Játékszoftver,Kiegészítők',
            'brand' => 'required|max:100',
            'short_description' => 'required',
            'full_description' => 'required',
            'original_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Aktív,Inaktív,Hamarosan érkezik,Elfogyott',
            'warranty_months' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_new_arrival' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specifications' => 'nullable|json',
            'tags' => 'nullable|json',
            'weight' => 'nullable|numeric|min:0',
            'shipping_details' => 'nullable|json',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Termék létrehozása
        $product = Product::create([
            ...$validatedData,
            'slug' => Str::slug($validatedData['name']),
        ]);

        // Képek feltöltése és mentése
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => Storage::url($path),
                    'is_primary' => $index === 0, // Az első kép legyen az elsődleges
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Termék sikeresen létrehozva!');
    }

    /**
     * Termék szerkesztési űrlap
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('layouts.admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Termék frissítése
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'type' => 'required|in:Konzol,Számítógép,Laptop,Perifériák,Játékszoftver,Kiegészítők',
            'brand' => 'required|max:100',
            'short_description' => 'required',
            'full_description' => 'required',
            'original_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Aktív,Inaktív,Hamarosan érkezik,Elfogyott',
            'warranty_months' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_new_arrival' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specifications' => 'nullable|json',
            'tags' => 'nullable|json',
            'weight' => 'nullable|numeric|min:0',
            'shipping_details' => 'nullable|json',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Termék frissítése
        $product->update($validatedData);

        // Képek frissítése
        if ($request->hasFile('images')) {
            // Régi képek törlése
            ProductImage::where('product_id', $product->id)->delete();

            // Új képek feltöltése
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => Storage::url($path),
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Termék sikeresen frissítve!');
    }

    /**
     * Termék törlése
     */
    public function destroy(Product $product)
    {
        // Képek törlése
        ProductImage::where('product_id', $product->id)->delete();

        // Termék törlése
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Termék sikeresen törölve!');
    }
}
