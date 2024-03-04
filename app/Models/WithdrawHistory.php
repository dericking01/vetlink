<?php

namespace App\Models;

use App\Models\seller\SellerBankInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'seller_id',
        'amount',
        'seller_bank_info_id'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function bankInfo()
    {
        return $this->belongsTo(SellerBankInfo::class,'seller_bank_info_id');
    }
}
