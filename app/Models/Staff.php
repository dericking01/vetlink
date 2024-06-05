<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable, HasApiTokens;

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
