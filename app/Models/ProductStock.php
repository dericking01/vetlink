<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_stock';

    // Fields that can be mass-assigned
    protected $fillable = [
        'admin_product_id',
        'branch_id',
        'total_quantity',
        'available_quantity',
    ];

    // relationship to AdminProduct model
    public function adminProduct()
    {
        return $this->belongsTo(AdminProduct::class, 'admin_product_id');
    }

    // relationship to Branch model
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
