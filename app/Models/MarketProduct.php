<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "market_products";

    // not sure if these should be fillable but these attributes are to be supplied by user NOT admins
    protected $fillable = [
        'name',
        'service_category_id',
        'product_category_id',
        'quantity',
        'sellerid',
        'price',
        'identifier',
        'purchasedQty',
        'image',
        'description',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'isApproved' => 'string' // should be updated by admin Approve/Reject ACTION
    ];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value); // Capitalize each word in the name
    }
    
    public function orderItems()
    {
        return $this->morphMany(OrderItems::class, 'productable');
    }
}
