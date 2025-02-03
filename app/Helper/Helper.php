<?php

use App\Models\Attribute;
use App\Models\Attributevalue;
use App\Models\Category;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Page;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Quoteitem;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getParentMenu')) {
    function getParentMenu()
    {
        $categories = Category::where('parent_id', 0)->where('show_in_menu', 1)->where('status', 1)->get();
        return $categories;
    }
}
if (!function_exists('getSubMenu')) {
    function getSubMenu($parentId)
    {
        $categories = Category::where('parent_id', $parentId)->where('show_in_menu', 1)->where('status', 1)->get();
        return $categories;
    }
}
if (!function_exists('getProduct')) {
    function getProduct()
    {

        $product = Product::where('status', 1)->get();
        return $product;
    }
}


if (!function_exists('getPage')) {
    function getPage()
    {

        $page = Page::where('status', 1)->get();
        return $page;
    }
}


if (!function_exists('cartCount')) {
    function cartCount()
    {
        $count = 0;
        if (auth()->check()) {
            $user = auth()->user();
            $cartId = session('cart_id');
            if ($cartId) {
                $quote = Quote::where('cart_id', $cartId)->where('user_id', $user->id)->first();
                if ($quote) {
                    $quoteId = $quote->id;
                    $count = Quoteitem::where('quote_id', $quoteId)->sum('qty');
                }
            }
        } else {
            $cartId = session('cart_id');
            if ($cartId) {
                $quote = Quote::where('cart_id', $cartId)->first();
                if ($quote) {
                    $quoteId = $quote->id;
                    $count = Quoteitem::where('quote_id', $quoteId)->sum('qty');
                }
            }
        }
        return $count;
    }
}


if (!function_exists('cartRecord')) {
    function cartRecord()
    {
        $cartId = session('cart_id');

        if ($cartId) {
            $cart = Quote::where('cart_id', $cartId)->first();
            if ($cart) {
                $cartItems = Quoteitem::where('quote_id', $cart->id)->get();
                return $cartItems;
            }
        }
        return [];
    }
}

if (!function_exists('wishlist')) {
    function wishlist()
    {
        $user_id = Auth::id();
        $count = 0;
        if ($user_id) {
            $count = Wishlist::where('user_id', $user_id)->count();
        }
        return $count;
    }
}


if (!function_exists('wishlistshow')) {
    function wishlistshow()
    {
        $Auth_id = Auth::id();
        $wishlist = 0;

        if ($Auth_id) {
            $wishlists = Wishlist::where('user_id', $Auth_id)->first();
            $wishlist = Wishlist::where('user_id', $Auth_id)->get();

            return $wishlist;
        }
    }
}

if (!function_exists('order')) {
    function order()
    {
        $order_id = Order::find('id');
        $orderget = Order::where('id', $order_id)->first();

        $order = Order::where('id', $order_id)->get();

        return $order;
    }
}
if (!function_exists('color')) {
    function color()
    {
        $attribute = Attribute::where('name', 'color')->first();

        if ($attribute) {
            $color = $attribute->attributevalues->pluck('attributevalue');
            return $color;
        } else {
            return collect(); 
        }
    }
}

