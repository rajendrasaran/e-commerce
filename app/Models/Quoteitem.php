<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Quoteitem extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    
    protected $table= 'quote_items';
    protected $fillable =[
        "quote_id", 
        "product_id", 
        "name", 
        "sku", 
        "price", 
        "qty", 
        "row_total"
     ];

     public function product(){
        return $this->belongsTo(Product::class);
     }
}
