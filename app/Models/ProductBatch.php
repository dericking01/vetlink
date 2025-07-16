<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'admin_id',
        'quantity',
        'buying_price',
        'expiry_date',
        'stocking_date'
    ];
}
