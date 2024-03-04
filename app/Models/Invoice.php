<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "invoice";

    protected $fillable = [
        'discount',
        'SabTax',
        'DueDate',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'orders_id');
    }

}
