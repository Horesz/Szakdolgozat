<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * A tömegesen kitölthető attribútumok.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'subtotal',
    ];

    /**
     * A rendelés, amihez az elem tartozik.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * A termék, amit megrendeltek.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Termék kép elérési útja.
     * 
     * @return string
     */
    public function getImagePathAttribute()
    {
        // Ha van kapcsolódó termék és van hozzá kép
        if ($this->product && $this->product->images()->exists()) {
            return $this->product->images()->where('is_primary', 1)->first()->image_path;
        }
        
        // Alapértelmezett kép, ha nincs termék kép
        return 'images/no-image.jpg';
    }
}