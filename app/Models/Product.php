<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        'name',
        'service_category_id',
        'product_category_id',
        'seller_id',
        'quantity',
        'wholesale_minimum_qty',
        'price',
        'discount',
        'image',
        'description',
        'status'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function orderItems()
    {
        return $this->morphMany(OrderItems::class, 'productable');
    }
}
