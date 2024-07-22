<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_product';

    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'address',
        'status',
        'total_amount',
        'payment_qr'
    ];

    public function orderItemproduct() : HasMany{
        return $this->hasMany(OrderItemProduct::class,'order_id','id');
    }
}
