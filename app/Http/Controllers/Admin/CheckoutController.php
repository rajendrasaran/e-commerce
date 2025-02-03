<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\Orderitem;
use App\Models\Quote;
use App\Models\Quoteitem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cartId = session('cart_id');

        $cart = Quote::where('cart_id', $cartId)->first();

        $cartItems = Quoteitem::where('quote_id', $cart->id)->get();

        return view('list.checkout', compact('cartItems'));
    }


    public function checkoutstore(Request $request)
    {


        $id = $request->input('id');
        $cartId = session('cart_id');
        $cart = Quote::where('cart_id', $cartId)->first();
        $quote_id = $cart->items;
        $quote = Quoteitem::where('quote_id', $quote_id)->get();
        $total = $quote->sum('row_total');



        $order_increment_id = $request->input('order_increment_id');
        $name   =   $request->input('name');
        $email  =   $request->input('email');
        $phone  =   $request->input('phone');
        $address =   $request->input('address');
        $city   =   $request->input('city');
        $country =   $request->input('country');
        $state  =   $request->input('state');
        $pincode =   $request->input('pincode');
        // $total = $request->$total;
        $payment_method = $request->input('payment_method');




        $order = [
            "user_id"         => Auth::id(),
            "name"            => $name,
            "email"           => $email,
            "phone"           => $phone,
            "address"         => $address,
            "city"            => $city,
            "state"           => $state,
            "country"         => $country,
            "pincode"         => $pincode,
            "total"           => $total,
            "payment_method"  => $payment_method,
            "shipping_method" => 'shipping_method'


        ];
        
        $order['order_increment_id'] = Str::slug('') .  date('YmdHis');

        $orderId = Order::create($order);
        $order_id = $orderId->id;

        OrderAddress::where('order_id', $order_id)->first();

        $orderAddress = [
            "order_id"     => $order_id,
            "name"         => $request->name,
            "email"        => $request->email,
            "phone"        => $request->phone,
            "address"      => $request->address,
            "city"         => $request->city,
            "state"        => $request->state,
            "country"      => $request->country,
            "pincode"      => $request->pincode,
            "address_type" => $request->address_type
        ];

        $orderaddress = OrderAddress::create($orderAddress);

        $quote_id = $cart->id;
        $quote = Quoteitem::where('quote_id', $quote_id)->get();

        if ($quote) {
            foreach ($quote as $quoteitem) {
                Orderitem::create([
                    "order_id" => $order_id,
                    "product_id" => $quoteitem->product_id,
                    "name" => $quoteitem->name,
                    "sku" => $quoteitem->sku,
                    "price" => $quoteitem->price,
                    "qty" => $quoteitem->qty,
                    "row_total" => $quoteitem['qty'] * $quoteitem['price'],
                ]);
            }

            return redirect('success');
        }
    }
    public function success()
    {
        return view('success.success');
    }


    public function wishlist(Request $request)
    {
        if(Auth::user()){
        $user_id = Auth::id()??0;

        $product_id = $request->input('id');
        $wishlist = Wishlist::where('product_id', $product_id)->first(); 
    
        if (!$wishlist) {
            $wishlist = Wishlist::create([
                "user_id" => $user_id,
                "product_id" => $product_id
            ]);
            return redirect()->back()->withSuccess('Added to Wishlist...');
        } else {
            $wishlist->delete();
            return redirect()->back()->withSuccesss('Removed from Wishlist...');
        }
    } else{
        return redirect()->route('loginAdmin')->withError('Login This User...');
    }
    }
    

    public function  wishlistd($id)
    {
        $wishlist = Wishlist::find($id);

        $wishlist->delete();
        return redirect()->back();
    }
}
