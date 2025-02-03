<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 1)->where('stock_status', 1);
    
        // Apply price filter if selected
        if ($request->has('price')) {
            $priceRange = $request->input('price');
        
            if ($priceRange === '200+') {
                $query->where('price', '>', 200);
            } else {
                $range = explode('-', $priceRange);
                $minPrice = $range[0];
                $maxPrice = $range[1];
        
                $query->whereBetween('price', [$minPrice, $maxPrice]);
            }
        }
        $product = $query->get();
    
        $slider = Slider::where('status', 1)->limit(2)->get();
        $sliders = Slider::where('status', 1)->orderByDesc('id')->limit(1)->get();
    
        return view('Admin.index', compact('slider', 'sliders', 'product'));
    }
}
