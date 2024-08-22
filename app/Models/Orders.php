<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "orders";

    protected $fillable = [
        'agent_id',
        'branch_id',
        'discount',
        'payment_method',
        'isDelivered',
        'status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id','id');
    }
}
