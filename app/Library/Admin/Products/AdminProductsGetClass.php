<?php

namespace App\Library\Admin\Products;

use App\Product;

class AdminProductsGetClass
{
    public function get_products_list($limit = 6)
    {
        $products = Product::orderBy('id', 'desc')
            ->limit($limit)
            ->get();
        return $products;
    }

}