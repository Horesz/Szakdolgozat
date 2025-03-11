<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes, HasSlug, HasFactory;

    protected $fillable = [
        'name', 'slug', 'price', 'stock_quantity', 'category_id',
        'type', 'brand', 'short_description', 'full_description',
        'original_price', 'discount_percentage', 'status', 
        'warranty_months', 'is_featured', 'is_new_arrival', 
        'specifications', 'tags', 'average_rating', 
        'total_reviews', 'weight', 'shipping_details',
        'meta_title', 'meta_description', 'meta_keywords'
    ];
    
    protected $casts = [
        'price' => 'float',
        'original_price' => 'float',
        'specifications' => 'array',
        'tags' => 'array',
        'shipping_details' => 'array',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'discount_percentage' => 'integer',
        'stock_quantity' => 'integer',
        'warranty_months' => 'integer',
        'weight' => 'float',
    ];

    /**
     * Slug beállítása automatikus generáláshoz.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Kapcsolat a kategóriákkal.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Kapcsolat a termékképekkel.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Kapcsolat az értékelésekkel.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Kapcsolat az akciós árakkal.
     */
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    /**
     * Kapcsolat a kapcsolódó termékekkel.
     */
    public function relatedProducts()
    {
        return $this->hasMany(RelatedProduct::class, 'product_id');
    }

    /**
     * Aktuális ár kiszámítása (kedvezménnyel vagy anélkül).
     */
    public function getCurrentPriceAttribute()
    {
        return $this->discount_percentage > 0
            ? round($this->price * (1 - $this->discount_percentage / 100), 2)
            : $this->price;
    }

    /**
     * Elérhetőség ellenőrzése.
     */
    public function getIsAvailableAttribute()
    {
        return $this->stock_quantity > 0 && $this->status === 'Aktív';
    }

    /**
     * Fő termékkép visszaadása (ha van).
     */
    public function getMainImageAttribute()
    {
        return $this->images()->where('is_primary', true)->first()->image_path ?? null;
    }

    /**
     * Átlagos értékelés lekérése a vélemények alapján.
     */
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }
}
