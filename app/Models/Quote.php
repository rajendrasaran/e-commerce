<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Quote extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable =[
       "cart_id", 
       "user_id", 
       "name", 
       "email", 
       "phone", 
       "address", 
       "city", 
       "state", 
       "pincode", 
       "subtotal", 
       "coupon", 
       "coupon_discount", 
       "total"
    ];
}
