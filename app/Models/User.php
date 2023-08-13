<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'card_number',
        'pin',
    ];

    protected $hidden = [
        'pin',
        'remember_token',
    ];

    protected $casts = [
        'pin' => 'hashed',
    ];


    /**
     * Check For User pin against a given pin
     */
    public function checkPin(string $coming): bool
    {
        return Hash::check($coming, $this->getPin());
    }

    public function getPin(): string
    {
        return $this->pin;
    }

    // Relations

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function transactions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Transaction::class,
            Account::class,
            'user_id',
            'account_id',
            'id',
            'id'
        );
    }
}
