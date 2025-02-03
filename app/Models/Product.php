<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
            'name',
            'is_featured',
            'sku',
            'qty',
            'stock_status',
            'status',
            'weight',
            'price',
            'special_price',
            'special_price_from',
            'special_price_to',
            'short_description',       
            'category',
            'description',
            'url_key',
            'related_product',
            'meta_title',
            'meta_keyword',
            'meta_description',
    ];



    public function categories() {
        return $this->belongsToMany(Category::class,'product_categories');
    }
}
