<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'admin_product_id',
        'quantity',
        'price',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function adminProduct()
    {
        return $this->belongsTo(AdminProduct::class, 'admin_product_id');
    }

    public function productStock()
    {
        return $this->belongsTo(ProductStock::class, 'admin_product_id', 'admin_product_id')
                    ->where('branch_id', $this->branch_id);
    }


}
