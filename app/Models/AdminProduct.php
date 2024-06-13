<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdminProduct extends Model
{
    use Notifiable,
        HasApiTokens,
        // MustVerifyEmail,
        HasFactory,
        SoftDeletes;

    protected $table = 'admin_products';


    protected $fillable = [
            'admin_id',
            'branch_id',
            'name',
            'quantity',
            'price',
            'description',
            'status',
            'image',
    ];

    // the relationship with the Admin model
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'admin_product_id');
    }

    public function orderItem()
    {
        return $this->morphMany(OrderItems::class, 'productable');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
