<?php

namespace App\Models;

use App\Models\seller\SellerBankInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Seller extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'gender',
        'location',
        'status',
        'date_of_birth',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function marketProducts()
    {
        return $this->hasMany(MarketProduct::class);
    }

    public function sellerBankInfo()
    {
        return $this->hasMany(SellerBankInfo::class);
    }

    public function withdrawHistories()
    {
        return $this->hasMany(WithdrawHistory::class);
    }
}
