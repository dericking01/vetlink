<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_product_id',
        'branch_id',
        'quantity',
        'description',
    ];


    public function adminProduct()
    {
        return $this->belongsTo(AdminProduct::class, 'admin_product_id');
    }

    // relationship to Branch model
    // public function branch()
    // {
    //     return $this->belongsTo(Branch::class, 'branch_id');
    // }

}
