<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'original_price',
        'discount',
        'image',
        'category_id',
        'stock',
        'featured',
        'status' // 'active', 'inactive'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount' => 'integer',
        'featured' => 'boolean',
        'stock' => 'integer'
    ];

    // Kapcsolat a kategóriával
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Ár számítás kedvezménnyel
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount) {
            return $this->price * (1 - $this->discount / 100);
        }
        return $this->price;
    }

    // Készlet státusz
    public function getStockStatusAttribute()
    {
        if ($this->stock > 10) {
            return 'Raktáron';
        } elseif ($this->stock > 0) {
            return 'Utolsó darabok';
        }
        return 'Nincs raktáron';
    }
}