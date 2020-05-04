<?php

namespace App\Http\Controllers;

use App\Library\ProductsCreate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{

    public function product_list()
    {
        $product = \App\Product::orderBy('id', 'asc') -> get();
        return view('product-adding', compact($product));
    }

    public function product_add(Request $request)
    {
        $product = new ProductsCreate($request);
        return $product->run();
    }
}