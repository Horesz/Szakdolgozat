<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Listázza az összes terméket
    public function index()
    {
        $products = Product::all(); // Minden termék lekérdezése
        return view('admin.products.index', compact('products'));
    }

    // Megjeleníti a termék felvételére szolgáló űrlapot
    public function create()
    {
        $categories = Category::all(); // Kategóriák lekérdezése
        return view('admin.products.create', compact('categories'));
    }

    // Új termék mentése
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
            'stock' => 'required|integer',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->original_price = $request->original_price;
        $product->discount = $request->discount;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->featured = $request->has('featured');
        
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen hozzáadva!');
    }

    // Megjeleníti a termék szerkesztésére szolgáló űrlapot
    public function edit(Product $product)
    {
        $categories = Category::all(); // Kategóriák lekérdezése
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Frissíti a termék adatokat
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id,
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
            'stock' => 'required|integer',
        ]);

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->original_price = $request->original_price;
        $product->discount = $request->discount;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->featured = $request->has('featured');
        
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen frissítve!');
    }

    // Törli a terméket
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Termék sikeresen törölve!');
    }
}
