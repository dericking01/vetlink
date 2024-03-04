<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'CatName',
        'status',
        'Description',
    ];

    public function setCatNameAttribute($value)
    {
        $this->attributes['catName'] = ucwords($value);
    }
}
