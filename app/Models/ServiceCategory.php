<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'catName',
        'status',
        'description',
    ];

    public function setCatNameAttribute($value)
    {
        $this->attributes['CatName'] = ucwords($value); // Capitalize each word in the name
    }
}
