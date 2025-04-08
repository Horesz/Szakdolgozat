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
        if (!(auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'munkatars'))) {
            return redirect('/')->with('error', 'Nincs jogosultságod ehhez a művelethez!');
        }
        
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
        try {
            Log::info('Termék frissítési kérés adatai:', [
                'request_data' => $request->all(),
                'product_id' => $product->id
            ]);
            
            // Alapos validálás
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'type' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'discount_percentage' => 'nullable|numeric|min:0|max:100',
                'stock_quantity' => 'required|integer|min:0',
                'status' => 'required|string|max:255',
                'short_description' => 'required|string',
                'full_description' => 'required|string',
            ]);
            
            // Checkbox mezők kezelése
            $validatedData['is_featured'] = $request->has('is_featured') ? 1 : 0;
            $validatedData['is_new_arrival'] = $request->has('is_new_arrival') ? 1 : 0;
            
            // Frissítés előtti állapot rögzítése
            $oldCategoryId = $product->category_id;
            
            // Termék frissítése
            $product->update($validatedData);
            
            // Kategória változás ellenőrzése
            $categoryChanged = ($oldCategoryId != $product->category_id);
            
            Log::info('Termék frissítés eredménye:', [
                'product_id' => $product->id,
                'old_category_id' => $oldCategoryId,
                'new_category_id' => $product->category_id,
                'category_changed' => $categoryChanged
            ]);
            
            if ($categoryChanged) {
                $categoryName = Category::find($product->category_id)->name ?? 'ismeretlen';
                return redirect()->route('admin.products.index')
                    ->with('success', "Termék sikeresen frissítve! A kategória átállítva: {$categoryName}");
            } else {
                return redirect()->route('admin.products.index')
                    ->with('success', 'Termék sikeresen frissítve!');
            }
            
        } catch (\Exception $e) {
            Log::error('Hiba termék frissítésekor:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->withErrors('Hiba történt a termék módosítása közben: ' . $e->getMessage());
        }
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

    // ProductController.php - browse metódus
public function browse(Request $request)
{
    // Kategória szűrés
    $categoryId = $request->input('category');
    $query = Product::where('status', 'Aktív');
    
    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }
    
    // Ár szűrés
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');
    
    if ($minPrice) {
        $query->where('price', '>=', $minPrice);
    }
    
    if ($maxPrice) {
        $query->where('price', '<=', $maxPrice);
    }
    
    // Rendezés
    $sort = $request->input('sort', 'newest'); // alapértelmezett: legújabb
    
    switch ($sort) {
        case 'price_low':
            $query->orderBy('price', 'asc');
            break;
        case 'price_high':
            $query->orderBy('price', 'desc');
            break;
        case 'name':
            $query->orderBy('name', 'asc');
            break;
        case 'newest':
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }
    
    // Keresés
    $search = $request->input('search');
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('short_description', 'like', "%{$search}%")
              ->orWhere('full_description', 'like', "%{$search}%");
        });
    }
    
    // Lapozás
    $products = $query->paginate(12);
    $categories = Category::where('status', 'active')->get();
    
    return view('layouts.admin.products.browse', compact('products', 'categories'));
}
public function show(Product $product)
{
    // Specifications JSON string dekódolása tömbbé, ha nem üres
    if ($product->specifications) {
        $product->specifications = json_decode($product->specifications, true) ?? [];
    } else {
        $product->specifications = [];
    }
    
    // Technical details JSON string dekódolása, ha van
    if ($product->technical_details) {
        $product->technical_details = json_decode($product->technical_details, true) ?? [];
    } else {
        $product->technical_details = [];
    }
    
    // Shipping details JSON string dekódolása, ha van
    if ($product->shipping_details) {
        $product->shipping_details = json_decode($product->shipping_details, true) ?? [];
    } else {
        $product->shipping_details = [];
    }
    
    // Tags JSON string dekódolása, ha van
    if ($product->tags) {
        $product->tags = json_decode($product->tags, true) ?? [];
    } else {
        $product->tags = [];
    }
    
    // A termék megtekintésének rögzítése (analitikához)
    // Ezt később ki lehet egészíteni a tényleges használat szerint
    
    // Kapcsolódó termékek lekérése
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->where('status', 'Aktív')
        ->inRandomOrder()
        ->take(4)
        ->get();
    
    return view('layouts.admin.products.show', compact('product', 'relatedProducts'));
}
    
    /**
     * Értékelés hozzáadása egy termékhez
     */
    public function review(Request $request, Product $product)
    {
        // Validálás
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'comment' => 'required|string'
        ]);
        
        // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'A vélemény írásához be kell jelentkezni.');
        }
        
        // Értékelés mentése
        // Ez a kód feltételezi, hogy van egy Review modell - ha később ezt implementálod
        /*
        $review = new Review([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment
        ]);
        $review->save();
        */
        
        // Sikeres üzenet
        return redirect()->back()->with('success', 'Köszönjük az értékelését! Az értékelés moderálás után lesz látható.');
    }
    
    /**
     * Termék hozzáadása a kosárhoz
     */
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity', 1);
        
        // Ellenőrizzük, hogy van-e elegendő készlet
        if ($product->stock_quantity < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Nincs elegendő készlet'
            ]);
        }
        
        // Kosár kezdése, ha még nincs
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        
        $cart = session()->get('cart');
        
        // Ha a termék már van a kosárban, növeljük a mennyiséget
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Ha még nincs, hozzáadjuk
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->images()->exists() ? $product->images()->where('is_primary', 1)->first()->image_path : 'images/no-image.jpg'
            ];
        }
        
        session()->put('cart', $cart);
        
        // Kosár termékek számának frissítése a session-ben
        $cartCount = array_sum(array_column($cart, 'quantity'));
        session()->put('cart_count', $cartCount);
        
        return response()->json([
            'success' => true,
            'message' => 'Termék sikeresen hozzáadva a kosárhoz',
            'cartCount' => $cartCount
        ]);
    }


}
