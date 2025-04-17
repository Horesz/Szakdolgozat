<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'firstname',
        'lastname',
        'email',
        'phone',
        'address_zip',
        'address_city',
        'address_street',
        'address_additional',
        'subtotal',
        'shipping_cost',
        'discount',
        'loyalty_points_used',
        'loyalty_points_earned',
        'total',
        'shipping_method',
        'payment_method',
        'payment_status',
        'order_status',
        'order_notes',
        'coupon_code',
        'is_guest',
        'guest_token'
    ];

    protected $casts = [
        'subtotal' => 'float',
        'shipping_cost' => 'float',
        'discount' => 'float',
        'total' => 'float',
        'loyalty_points_used' => 'integer',
        'loyalty_points_earned' => 'integer',
        'is_guest' => 'boolean',
    ];

    /**
     * A rendeléshez tartozó felhasználó.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A rendeléshez tartozó tételek.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Egyedi rendelési szám generálása.
     *
     * @return string
     */
    public static function generateOrderNumber()
    {
        $prefix = 'GS';
        $date = Carbon::now()->format('ymd');
        $randomString = strtoupper(Str::random(4));
        
        return $prefix . $date . $randomString;
    }

    /**
     * Egyedi vendég token generálása a rendelés követéséhez.
     *
     * @return string
     */
    public static function generateGuestToken()
    {
        return Str::random(32);
    }

    /**
     * A szállítási mód nevének lekérdezése.
     *
     * @return string
     */
    public function getShippingMethodNameAttribute()
    {
        switch ($this->shipping_method) {
            case 'courier':
                return 'Házhozszállítás futárral';
            case 'pickup_point':
                return 'Csomagpont';
            case 'store':
                return 'Személyes átvétel üzletünkben';
            default:
                return $this->shipping_method;
        }
    }

    /**
     * A fizetési mód nevének lekérdezése.
     *
     * @return string
     */
    public function getPaymentMethodNameAttribute()
    {
        switch ($this->payment_method) {
            case 'card':
                return 'Bankkártyával online';
            case 'transfer':
                return 'Banki átutalás';
            case 'cod':
                return 'Utánvét';
            default:
                return $this->payment_method;
        }
    }

    /**
     * A rendelési státusz nevének lekérdezése.
     *
     * @return string
     */
    public function getOrderStatusNameAttribute()
    {
        switch ($this->order_status) {
            case 'pending':
                return 'Feldolgozás alatt';
            case 'processing':
                return 'Feldolgozva';
            case 'shipped':
                return 'Kiszállítva';
            case 'delivered':
                return 'Kézbesítve';
            case 'cancelled':
                return 'Törölve';
            default:
                return $this->order_status;
        }
    }

    /**
     * A fizetési státusz nevének lekérdezése.
     *
     * @return string
     */
    public function getPaymentStatusNameAttribute()
    {
        switch ($this->payment_status) {
            case 'pending':
                return 'Fizetésre vár';
            case 'processing':
                return 'Feldolgozás alatt';
            case 'paid':
                return 'Kifizetve';
            case 'refunded':
                return 'Visszatérítve';
            case 'failed':
                return 'Sikertelen';
            default:
                return $this->payment_status;
        }
    }

    /**
     * A rendelés teljes neve (vezetéknév és keresztnév).
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->lastname} {$this->firstname}";
    }

    /**
     * A rendelés teljes címe.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return implode(', ', array_filter([
            $this->address_zip,
            $this->address_city,
            $this->address_street,
            $this->address_additional
        ]));
    }

    /**
     * Ellenőrzi, hogy a rendelés lemondható-e.
     * Csak akkor mondható le, ha a státusz pending vagy processing.
     *
     * @return bool
     */
    public function canBeCancelled()
    {
        $cancellableStatuses = ['pending', 'processing'];
        return in_array($this->order_status, $cancellableStatuses);
    }

    /**
     * Ellenőrzi, hogy a rendelés kifizetett-e.
     *
     * @return bool
     */
    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    /**
     * A rendelés létrehozása óta eltelt idő emberi olvasható formában.
     *
     * @return string
     */
    public function getElapsedTimeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * A rendelésben szereplő termékek száma.
     *
     * @return int
     */
    public function getItemCountAttribute()
    {
        return $this->items->sum('quantity');
    }

    /**
     * Lekérdezi, hogy a rendelésben használtak-e fel hűségpontokat.
     *
     * @return bool
     */
    public function hasUsedLoyaltyPoints()
    {
        return $this->loyalty_points_used > 0;
    }

    /**
     * Lekérdezi, hogy a rendelésért kaptak-e hűségpontokat.
     *
     * @return bool
     */
    public function hasEarnedLoyaltyPoints()
    {
        return $this->loyalty_points_earned > 0;
    }

    /**
     * Kiszámolja a hűségpontokból származó kedvezményt.
     *
     * @return float
     */
    public function getLoyaltyDiscountAttribute()
    {
        // 10 pont = 100 Ft
        return floor($this->loyalty_points_used / 10) * 100;
    }
}