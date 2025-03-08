<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'discount_price', 'start_date', 'end_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Ellenőrzi, hogy a kedvezmény jelenleg aktív-e.
     */
    public function isActive()
    {
        $now = Carbon::now();
        return $this->start_date <= $now && $this->end_date >= $now;
    }
}
