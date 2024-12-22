<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Agent extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;

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
        'promo_code',
        'points',
        'status',
        'agent_id',
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

    public function order()
    {
        return $this->hasMany(Orders::class);
    }

    public function orderItems()
    {
        return $this->hasMany(Orders::class);
    }

    public static function getCode()
    {
        $characters = 'ewlsnmdkztpzqprtba';
        $numericPart = mt_rand(1000000000000, 9999999999999) . mt_rand(1000000000000, 9999999999999);
        $characterPart = $characters[rand(0, strlen($characters) - 1)];

        $code = str_shuffle($numericPart . $characterPart);
        return $code;
    }

}
