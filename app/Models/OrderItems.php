<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class OrderItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "order_items";

    protected $fillable = [
        'order_id',
        'productable_id',
        'seller_id',
        'productable_type',
        'quantity',
        'price',
        'deductable_id',
        'amount',
        'discount',
        'status',
        'agent_id'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function productable()
    {
        return $this->morphTo();
    }

}
