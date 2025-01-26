<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use SoftDeletes, HasSlug;
    use HasFactory, HasSlug;


    protected $fillable = [
        'name', 'slug', 'price', 'stock_quantity', 'category_id', 
        'type', 'brand', 'specifications', 'short_description', 
        'full_description', 'original_price', 'discount_percentage', 
        'status', 'warranty_months', 'is_featured', 
        'is_new_arrival', 'images', 'technical_details', 
        'tags', 'average_rating', 'total_reviews', 
        'weight', 'shipping_details'
    ];

    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'tags' => 'array',
        'shipping_details' => 'array',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean'
    ];

    // Slug generálás automatikusan

    /**
     * A slug opcióinak beállítása.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name') // Ezt a mezőt használja a slug generálásához
            ->saveSlugsTo('slug');     // Ebbe a mezőbe menti a slugot
    }

    // Kategória kapcsolat
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Aktuális ár kalkuláció
    public function getCurrentPriceAttribute()
    {
        return $this->discount_percentage > 0 
            ? $this->price * (1 - $this->discount_percentage / 100) 
            : $this->price;
    }

    // Elérhetőség ellenőrzése
    public function getIsAvailableAttribute()
    {
        return $this->stock_quantity > 0 && $this->status === 'Aktív';
    }

    // Képek első képének elérése
    public function getMainImageAttribute()
    {
        return $this->images ? $this->images[0] : null;
    }
}