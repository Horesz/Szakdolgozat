<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // Nyilvános oldalak
    
    /**
     * Kategóriák listázása a publikus oldalon
     */
    public function index()
    {
        $categories = Category::where('status', 'active')->paginate(12);
        return view('categories.index', compact('categories'));
    }
    
    /**
     * Kategória megtekintése a publikus oldalon
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $products = $category->products()->where('status', 'Aktív')->paginate(12);
        
        return view('categories.show', compact('category', 'products'));
    }
    
    // Admin oldalak - jogosultság ellenőrzés
    
    /**
     * Ellenőrzi, hogy a felhasználó admin-e
     */
    private function checkAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Nincs jogosultságod ehhez a művelethez!');
        }
    }
    
    /**
     * Kategóriák listázása az admin felületen
     */
    public function adminIndex()
    {
        $this->checkAdmin();
        
        $categories = Category::withCount('products')->paginate(10);
        return view('layouts.admin.categories.index', compact('categories'));
    }
    
    /**
     * Új kategória létrehozása űrlap
     */
    public function create()
    {
        $this->checkAdmin();
        
        return view('layouts.admin.categories.create');
    }
    
    /**
     * Új kategória mentése
     */
    public function store(Request $request)
    {
        $this->checkAdmin();
        
        // Validálás
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        // Slug generálása a névből
        $validatedData['slug'] = Str::slug($validatedData['name']);

        // Kép feltöltése, ha van
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        // Kategória létrehozása
        Category::create($validatedData);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategória sikeresen létrehozva!');
    }
    
    /**
     * Kategória szerkesztése űrlap
     */
    public function edit(Category $category)
    {
        $this->checkAdmin();
        
        return view('layouts.admin.categories.edit', compact('category'));
    }
    
    /**
     * Kategória frissítése
     */
    public function update(Request $request, Category $category)
    {
        $this->checkAdmin();
        
        // Validálás
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'remove_image' => 'nullable|boolean',
        ]);

        // Kép kezelése
        if ($request->hasFile('image')) {
            // Régi kép törlése, ha volt
            if ($category->image && Storage::exists(str_replace('storage/', 'public/', $category->image))) {
                Storage::delete(str_replace('storage/', 'public/', $category->image));
            }

            // Új kép feltöltése
            $imagePath = $request->file('image')->store('categories', 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        } elseif ($request->has('remove_image') && $request->remove_image) {
            // Kép törlése, ha a remove_image be van jelölve
            if ($category->image && Storage::exists(str_replace('storage/', 'public/', $category->image))) {
                Storage::delete(str_replace('storage/', 'public/', $category->image));
            }
            $validatedData['image'] = null;
        } else {
            // Kép nem változott, kimarad a frissítésből
            unset($validatedData['image']);
        }

        // Töröljük a remove_image mezőt, mert nem tartozik a modellhez
        unset($validatedData['remove_image']);

        // Kategória frissítése
        $category->update($validatedData);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategória sikeresen frissítve!');
    }
    
    /**
     * Kategória törlése
     */
    public function destroy(Category $category)
    {
        $this->checkAdmin();
        
        // Ellenőrizzük, hogy van-e termék a kategóriában
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'A kategória nem törölhető, mert termékek vannak hozzárendelve!');
        }

        // Kép törlése, ha volt
        if ($category->image && Storage::exists(str_replace('storage/', 'public/', $category->image))) {
            Storage::delete(str_replace('storage/', 'public/', $category->image));
        }

        // Kategória törlése
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategória sikeresen törölve!');
    }
}