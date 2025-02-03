<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    protected $fillable =[
        'parent_id',
        'name',
        'show_in_menu',
        'status',
        'short_description',
        'description',
        'url_key'
    ];


    public function parent() {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function product() {
        return $this->belongsToMany(Product::class,'product_categories');
    }
    



}
