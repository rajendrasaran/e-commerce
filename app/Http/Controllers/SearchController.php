<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
{
    $keyword = $request->input('keyword');

    $product = Product::where('name', 'like', "%$keyword%")->orWhere('url_key', 'like', "%$keyword%")->orWhere('description', 'like', "%$keyword%")->orWhere('short_description', 'like', "%$keyword%")->orWhere('meta_description', 'like', "%$keyword%")->get();

    return view('list.product', ['product' => $product]);
}

}
