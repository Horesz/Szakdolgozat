<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 
        'lastname', 
        'email', 
        'phone',
        'birth_date',
        'address_zip',
        'address_city',
        'address_street',
        'address_additional',
        'password',
        'role',
        'is_active',
        'loyalty_points',
        'profile_image' // Új opcionális mező a profilképhez
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'is_active' => 'boolean',
        'loyalty_points' => 'integer',
    ];

    // Profilkép alapértelmezett értéke, ha nincs feltöltve
    public function getProfileImageAttribute($value)
    {
        // Ha van feltöltött kép, használd azt
        if ($value) {
            return $value;
        }
        
        // Ha nincs, visszatér egy alapértelmezett avatar URL-lel
        return 'images/default-avatar.png';
    }

    // Profilkép teljes URL-jének lekérése
    public function getProfileImageUrlAttribute()
    {
        // Ha a profilkép egy teljes URL, vagy storage-ban van
        if (filter_var($this->profile_image, FILTER_VALIDATE_URL)) {
            return $this->profile_image;
        }
        
        // Ha a kép a storage mappában van
        return $this->profile_image 
            ? asset('storage/' . $this->profile_image) 
            : asset('images/default-avatar.png');
    }

    // Password hash mutator
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Full name accessor
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    // Full address accessor
    public function getFullAddressAttribute()
    {
        return implode(', ', array_filter([
            $this->address_zip,
            $this->address_city,
            $this->address_street,
            $this->address_additional
        ]));
    }

    // Age calculation
    public function getAgeAttribute()
    {
        return $this->birth_date ? Carbon::parse($this->birth_date)->age : null;
    }

    /**
     * A felhasználó rendeléseinek lekérdezése.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Ellenőrzi, hogy a felhasználó admin-e.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    /**
     * Ellenőrzi, hogy a felhasználó munkatárs-e.
     *
     * @return boolean
     */
    public function isMunkatars()
    {
        return $this->role === 'munkatars';
    }
    
    /**
     * Hűségpontok hozzáadása a felhasználóhoz.
     *
     * @param int $points
     * @return void
     */
    public function addLoyaltyPoints($points)
    {
        $this->loyalty_points = $this->loyalty_points + $points;
        $this->save();
    }
    
    /**
     * Hűségpontok levonása a felhasználótól.
     * Csak akkor von le, ha van elég pont.
     *
     * @param int $points
     * @return boolean
     */
    public function useLoyaltyPoints($points)
    {
        if ($this->loyalty_points >= $points) {
            $this->loyalty_points = $this->loyalty_points - $points;
            $this->save();
            return true;
        }
        
        return false;
    }
    
    /**
     * A beváltható kedvezmény összegének kiszámítása a hűségpontok alapján.
     * 10 pont = 100 Ft kedvezmény
     *
     * @return int
     */
    public function getAvailableDiscountAmount()
    {
        return floor($this->loyalty_points / 10) * 100;
    }
    
    /**
     * A felhasználó hűségpont szintjének lekérdezése.
     * 
     * @return string
     */
    public function getLoyaltyLevelAttribute()
    {
        if ($this->loyalty_points >= 1000) {
            return 'Platina';
        } elseif ($this->loyalty_points >= 500) {
            return 'Arany';
        } elseif ($this->loyalty_points >= 200) {
            return 'Ezüst';
        } elseif ($this->loyalty_points >= 50) {
            return 'Bronz';
        } else {
            return 'Alap';
        }
    }
    
    /**
     * Születésnapi kedvezmény ellenőrzése.
     * Ha a felhasználó születésnapja van, extra pontokat vagy kedvezményt kaphat.
     *
     * @return boolean
     */
    public function hasBirthdayToday()
    {
        if (!$this->birth_date) {
            return false;
        }
        
        $today = Carbon::today();
        $birthday = Carbon::parse($this->birth_date);
        
        return $today->month == $birthday->month && $today->day == $birthday->day;
    }
    
    /**
     * Ellenőrzi, hogy a felhasználó jogosult-e extra hűségpontokra
     * a regisztrációja évfordulóján.
     *
     * @return boolean
     */
    public function hasRegistrationAnniversaryToday()
    {
        $today = Carbon::today();
        $creationDate = Carbon::parse($this->created_at);
        
        return $today->month == $creationDate->month && 
               $today->day == $creationDate->day && 
               $today->year > $creationDate->year;
    }
}