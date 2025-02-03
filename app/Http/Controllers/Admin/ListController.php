<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Attributevalue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Quote;
use App\Models\Quoteitem; 
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index($slug)
    {
        $products = Category::where('url_key', $slug)->first();

        $product = $products->product()->get();
        return view('list.product', compact('product'));
    }
  
    public function detail($slug)
    {

        $products = Product::where('url_key', $slug)->first();
        if ($products) {
            $relatedProduct = explode(',', $products->related_product);
            $relProduct = Product::whereIn('id', $relatedProduct)->get();
        }
        $productAttributes = ProductAttribute::where('product_id', $products->id)->get();
        $attributes = [];

        foreach ($productAttributes as $productAttribute) {
            $attributeId = $productAttribute->attribute_id;
            $attributeValueId = $productAttribute->attributevalue_id;
            $attribute = Attribute::find($attributeId);
            $attributeValue = Attributevalue::find($attributeValueId);
            if ($attribute && $attributeValue) {
                if (!isset($attributes[$attribute->name])) {
                    $attributes[$attribute->name] = [];
                }
                $attributes[$attribute->name][] = $attributeValue;
            }
        }

        return view('list.detail_page', compact('products', 'relProduct', 'attributes'));
    }

    function cartRecord()
    {
        $cartId = session('cart_id');
        if ($cartId) {
            $cart = Quote::where('cart_id', $cartId)->first();
            if ($cart) {
                $cartItems = Quoteitem::where('quote_id', $cart->id)->get();
                return view('list.view-cart', compact('cartItems'));
            } else {
                return view('list.view-cart',)->with('message', 'Your Cart is emplty');
            }
        }
    }
}
