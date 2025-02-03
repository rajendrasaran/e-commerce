<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        "order_increment_id",
        "user_id",
        "name",
        "email",
        "phone",
        "address",
        "city",
        "state",
        "country",
        "pincode",
        "total",
        "payment_method",
        "shipping_method"

    ];


   
}
