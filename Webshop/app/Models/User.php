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
        'is_active'
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'is_active' => 'boolean',
    ];

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
}