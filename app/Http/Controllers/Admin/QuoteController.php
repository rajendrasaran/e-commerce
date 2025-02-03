<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Quoteitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
   public function cart(Request $request, $id)
   {
      $attributes=json_encode($request->input('attributes'));
      $cartId=session('cart_id');
      $qty = $request->input('qty', 1);
      if($cartId){  
          $quote = Quote::firstOrCreate(['cart_id'=>  $cartId]);
          $quoteId = $quote->id;
          $product = Product::where('id', $id)->first();
          
          $quoteData = [
              'quote_id' => $quoteId,
              'product_id' => $id,
              'name' => $product->name,
              'sku' => $product->sku,
              'price' => $product->price,
              'qty' => $qty,
              'custom_option'=>$attributes,
              'row_total'=>$qty * $product->price
          ];
          if(isset($product->special_price) && (date("Y-m-d") >= $product->special_price_from) && (date("Y-m-d") <= $product->special_price_to) ){
              $quoteData['price']=$product->special_price;
          }
                          
          $qtycheck=QuoteItem::where('quote_id', $quoteId)->where('product_id', $id)->first();
          if($qtycheck){
              $qtycheck->update([
                  'qty' => $qtycheck->qty + $qty,
                  'row_total' => ($qtycheck->qty+$qty) * $quoteData['price']
              ]);
              
          }else{

              $quoteData['row_total']=$qty*$quoteData['price'];
          QuoteItem::create($quoteData);

          }
          $quoteItems=QuoteItem::where('quote_id',$quoteId)->get();
          // dd($quoteItems);
          $total=0;
          foreach($quoteItems as $key=> $rowtotal ){
              $total+=$rowtotal->row_total; 
          }
          if(Auth::user()){    
              $quote->update([
                  'subtotal' =>$total,
                  'total'=>$total,
                  'user_id'=>Auth::user()->id,
              ]);
          }else{
              $quote->update([
                  'subtotal' =>$total,
                  'total'=>$total
              ]);
          }
          
          return redirect()->back()->withSuccess($product->name. ' Added to Cart Successfully');


      }else{
          $cartId=Str::random(20);
          session(['cart_id'=>$cartId]);
          
              $data=[
                  'cart_id'=> $cartId
               ];
          
          
          $quote = Quote::create($data);
          $quoteId=$quote->id;
          
          // dd($quoteId);
          $product = Product::where('id', $id)->first();
          // dd($product);
          $quoteData = [
              'quote_id' => $quoteId,
              'product_id' => $id,
              'name' => $product->name,
              'sku' => $product->sku,
              'price' => $product->price,
              'qty' => $qty,
              'custom_option'=>$attributes,
              'row_total'=>$qty*$product->price
          ];
          if(isset($product->special_price) && (date("Y-m-d") >= $product->special_price_from) && (date("Y-m-d") <= $product->special_price_to) ){
              $quoteData['price']=$product->special_price;
              
          }
          $quoteData['row_total']=$qty*$quoteData['price'];
          QuoteItem::create($quoteData);
          $quoteItems=QuoteItem::where('quote_id',$quoteId)->get();
           $subtotal=$quoteItems->sum('row_total');
           if(Auth::user()){
              $quote->update([
                  'subtotal' =>$subtotal,
                  'total'=>$subtotal,
                  'user_id'=>Auth::user()->id,
              ]);
          }else{
              $quote->update([
                  'subtotal' =>$subtotal,
                  'total'=>$subtotal
              ]);
          }   
          
          return redirect()->back()->withSuccess($product->name. ' Added to Cart Successfully');
      }
      
      
  }


   public function cartUpdate(Request $request)
   {
      $cartId = session('cart_id');
      $quoteId = $request->input('id');
      $qty = $request->input('qty');
      $quote = Quoteitem::findorfail($quoteId);
      $product = $quote->product_id;
      $productId = Product::where('id', $product)->first();
      $quotedata = [
         'qty' => $qty,
         'row_total' => ($qty) * $productId['price'],
      ];

      $quote->update($quotedata);
      return redirect()->back();
   }
   public function cartDelete($id)
   {
      $cartId = Quoteitem::find($id);

      $cartId->delete();
      return redirect()->back();
   }
   public function checkout()
   {
      return view('list.checkout');
   }
}
