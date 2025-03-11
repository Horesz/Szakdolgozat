<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('layouts.admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('layouts.admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Termék hozzáadási kísérlet:', $request->all());
            
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'type' => 'required',
                'brand' => 'required|max:100',
                'short_description' => 'required',
                'full_description' => 'required',
                'status' => 'required'
            ]);
            
            $product = new Product();
            $product->name = $validatedData['name'];
            $slug = Str::slug($validatedData['name']);
            $existingSlugs = Product::where('slug', 'like', $slug . '%')->pluck('slug')->toArray();

            if (in_array($slug, $existingSlugs)) {
                $count = 1;
                while (in_array($slug . '-' . $count, $existingSlugs)) {
                    $count++;
                }
                $slug = $slug . '-' . $count;
            }

            $product->slug = $slug;

            $product->category_id = (int) $validatedData['category_id'];
            $product->price = (float) $validatedData['price'];
            $product->stock_quantity = (int) $validatedData['stock_quantity'];
            $product->type = $validatedData['type'];
            $product->brand = $validatedData['brand'];
            $product->short_description = $validatedData['short_description'];
            $product->full_description = $validatedData['full_description'];
            $product->status = $validatedData['status'];
            
            $product->is_featured = $request->has('is_featured') ? 1 : 0;
            $product->is_new_arrival = $request->has('is_new_arrival') ? 1 : 0;
            
            $product->original_price = $request->filled('original_price') ? (float) $request->original_price : 0;
            $product->discount_percentage = $request->filled('discount_percentage') ? (int) $request->discount_percentage : 0;
            $product->warranty_months = $request->filled('warranty_months') ? (int) $request->warranty_months : 0;
            $product->weight = $request->filled('weight') ? (float) $request->weight : 0;
            
            $product->specifications = $request->input('specifications', '{}');
            $product->technical_details = $request->input('technical_details', '{}');
            $product->tags = $request->input('tags', '{}');
            $product->shipping_details = $request->input('shipping_details', '{}');
            
            $product->meta_title = $request->filled('meta_title') ? $request->meta_title : $product->name;
            $product->meta_description = $request->filled('meta_description') ? $request->meta_description : substr($product->short_description, 0, 150);
            $product->meta_keywords = $request->filled('meta_keywords') ? $request->meta_keywords : strtolower(str_replace(' ', ',', $product->name));
            
            $product->save();
            Log::info('Termék sikeresen mentve:', ['id' => $product->id]);
            
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => Storage::url($path),
                        'is_primary' => $index === 0,
                    ]);
                }
            }
            
            return redirect()->route('admin.products.index')->with('success', 'Termék sikeresen létrehozva!');
        } catch (\Exception $e) {
            Log::error('Hiba termék létrehozásánál:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Hiba történt a termék mentése közben.');
        }
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
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'type' => 'required',
            'brand' => 'required|max:100',
            'short_description' => 'required',
            'full_description' => 'required',
            'status' => 'required'
        ]);
        
        $product->update($validatedData);
        
        // Képek frissítése
        if ($request->hasFile('images')) {
            ProductImage::where('product_id', $product->id)->delete();
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => Storage::url($path),
                    'is_primary' => $index === 0,
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')->with('success', 'Termék sikeresen frissítve!');
    }

    /**
     * Termék törlése
     */
    public function destroy(Product $product)
    {
        ProductImage::where('product_id', $product->id)->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Termék sikeresen törölve!');
    }
}
