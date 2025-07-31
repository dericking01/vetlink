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
            'units',
            'expire_date',
            'price',
            'buying_price',
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

    public function branchProducts()
    {
        return $this->hasMany(BranchProduct::class, 'admin_product_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function productStocks(){
        return $this->hasMany(ProductStock::class, 'admin_product_id');
    }

    // Short stock
    public function shortStocks(){
        return $this->hasMany(ShortStock::class, 'admin_product_id');
    }

    public function getWarehouseQuantityAttribute(){
        $allocatedQuantity = $this->productStocks()->whereHas('branch', function($query){
            $query->where('branch_name', '!=', 'SHORT STOCK');
        })->sum('available_quantity');
        return $this->quantity - $allocatedQuantity;
    }
    
    // Relationship to ProductBatch
    public function productBatches()
    {
        return $this->hasMany(ProductBatch::class,'product_id');
    }

    // Function to get the earliest expiry date from ProductBatches
    public function getEarliestExpiryDate()
    {
        return $this->productBatches()
                    ->orderBy('expiry_date', 'asc') // Ordering by earliest expiry date
                    ->first() // Get the first one (earliest)
                    ->expiry_date ?? null; // Return the expiry date or null if no batches
    }

}
