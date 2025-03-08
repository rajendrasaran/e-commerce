<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        "order_id",
        "product_id",
        "name",
        "sku",
        "qty",
        "price",
        "row_total",
        "custom_option"
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
