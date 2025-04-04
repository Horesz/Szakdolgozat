<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * A tömegesen kitölthető attribútumok.
     *
     * @var array
     */
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
        'total',
        'shipping_method',
        'payment_method',
        'payment_status',
        'order_status',
        'order_notes',
        'coupon_code',
        'invoice_issued',
    ];

    /**
     * A felhasználó, aki a rendelést leadta.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A rendeléshez tartozó termékek.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Egyedi rendelésszám generálása
     * 
     * @return string
     */
    public static function generateOrderNumber()
    {
        // Egyedi rendelésszám generálása prefix + timestamp + random szám alapján
        $prefix = 'GS';
        $timestamp = date('YmdHis');
        $random = mt_rand(1000, 9999);
        
        return $prefix . $timestamp . $random;
    }

    /**
     * Rendelés státusz szöveges leírása
     * 
     * @return string
     */
    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Feldolgozás alatt',
            'processing' => 'Folyamatban',
            'shipped' => 'Szállítás alatt',
            'delivered' => 'Kézbesítve',
            'completed' => 'Teljesítve',
            'cancelled' => 'Lemondva',
            'refunded' => 'Visszatérítve'
        ];

        return $statuses[$this->order_status] ?? 'Ismeretlen';
    }

    /**
     * Fizetés státusz szöveges leírása
     * 
     * @return string
     */
    public function getPaymentStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Függőben',
            'paid' => 'Kifizetve',
            'failed' => 'Sikertelen',
            'refunded' => 'Visszatérítve'
        ];

        return $statuses[$this->payment_status] ?? 'Ismeretlen';
    }

    /**
     * Szállítási mód szöveges leírása
     * 
     * @return string
     */
    public function getShippingMethodTextAttribute()
    {
        $methods = [
            'courier' => 'Házhozszállítás futárral',
            'pickup_point' => 'Csomagpont',
            'store' => 'Személyes átvétel üzletünkben'
        ];

        return $methods[$this->shipping_method] ?? 'Ismeretlen';
    }

    /**
     * Fizetési mód szöveges leírása
     * 
     * @return string
     */
    public function getPaymentMethodTextAttribute()
    {
        $methods = [
            'card' => 'Bankkártyával online',
            'transfer' => 'Banki átutalás',
            'cod' => 'Utánvét'
        ];

        return $methods[$this->payment_method] ?? 'Ismeretlen';
    }

    /**
     * Rendelés teljes neve
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Teljes cím
     * 
     * @return string
     */
    public function getFullAddressAttribute()
    {
        $address = $this->address_zip . ' ' . $this->address_city . ', ' . $this->address_street;
        
        if ($this->address_additional) {
            $address .= ' (' . $this->address_additional . ')';
        }
        
        return $address;
    }

    /**
     * Ellenőrzi, hogy a rendelés lemondható-e
     * 
     * @return bool
     */
    public function canBeCancelled()
    {
        // Csak akkor lehet lemondani, ha még feldolgozás alatt vagy folyamatban van
        return in_array($this->order_status, ['pending', 'processing']);
    }

    /**
     * Ellenőrzi, hogy a rendelésre kiadható-e számla
     * 
     * @return bool
     */
    public function canBeInvoiced()
    {
        // Csak akkor lehet számlát készíteni, ha ki van fizetve és még nincs számlázva
        return $this->payment_status === 'paid' && !$this->invoice_issued;
    }

    /**
     * Lekérdezi a legutóbbi 5 rendelést
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getRecentOrders($limit = 5)
    {
        return self::with('user', 'items')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Lekérdezi a felhasználó rendeléseit
     * 
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUserOrders($userId)
    {
        return self::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}