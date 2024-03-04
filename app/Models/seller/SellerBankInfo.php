<?php

namespace App\Models\seller;

use App\Models\Seller;
use App\Models\WithdrawHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerBankInfo extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'type',
        'status',
        'issuer',
        'expires',
        'seller_id',
    ];


    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function withdrawHistories()
    {
        return $this->hasMany(WithdrawHistory::class);
    }
}
