<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "branches";

    protected $fillable = [
        'branch_name',
        'location',
        'status'
    ];

    public function order()
    {
        return $this->hasMany(Orders::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(AdminProduct::class);
    }

    public function branchProducts()
    {
        return $this->hasMany(BranchProduct::class);
    }
}
