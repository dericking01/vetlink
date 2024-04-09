<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "staffs";

    protected $fillable = [
        'admin_id',
        'name',
        'email',
        'phone',
        'role',
        'status',
        'location',
        'email_verified_at',
        'password',
        'avatar'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id','id');
    }
}
