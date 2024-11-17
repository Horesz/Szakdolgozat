<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status' // 'active', 'inactive'
    ];

    // Kapcsolat a termékekkel
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Aktív termékek lekérése
    public function activeProducts()
    {
        return $this->products()->where('status', 'active');
    }
}