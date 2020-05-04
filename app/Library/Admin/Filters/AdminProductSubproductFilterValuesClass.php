<?php

namespace App\Library\Admin\Filters;

use App\Library\Admin\Products\AdminProductsSubproductsClass;
use App\Product;
use App\Subproduct;

class AdminProductSubproductFilterValuesClass
{
    public function get_list()
    {
        $AdminProductsSubproductsClass = new AdminProductsSubproductsClass();
        $array = $AdminProductsSubproductsClass->make_array();
        return $array;
    }

    public function campaigns_count_min()
    {
        $products = Product::min('campaigns_count');
        $subproducts = Subproduct::min('campaigns_count');
        if($subproducts < $products){
            $result = $subproducts;
        } else {
            $result = $products;
        }
        return round((int)$result);
    }

    public function campaigns_count_max()
    {
        $products = Product::max('campaigns_count');
        $subproducts = Subproduct::max('campaigns_count');
        if($subproducts > $products){
            $result = $subproducts;
        } else {
            $result = $products;
        }
        return round((int)$result + 1);
    }

    public function total_spendings_min()
    {
        $products = Product::min('spendings_total');
        $subproducts = Subproduct::min('spendings_total');
        if($subproducts < $products){
            $result = $subproducts;
        } else {
            $result = $products;
        }
        return round((int)$result);
    }

    public function total_spendings_max()
    {
        $products = Product::max('spendings_total');
        $subproducts = Subproduct::max('spendings_total');
        if($subproducts > $products){
            $result = $subproducts;
        } else {
            $result = $products;
        }
        return round((int)$result + 1);
    }

    public function lw_spendings_min()
    {
        $products = Product::min('spendings_last_week');
        $subproducts = Subproduct::min('spendings_last_week');
        if($subproducts < $products){
            $result = $subproducts;
        } else {
            $result = $products;
        }
        return round((int)$result);
    }

    public function lw_spendings_max()
    {
        $products = Product::max('spendings_last_week');
        $subproducts = Subproduct::max('spendings_last_week');
        if($subproducts > $products){
            $result = $subproducts;
        } else {
            $result = $products;
        }
        return round((int)$result + 1);
    }

    public function get_array()
    {
        $result = array();
        $array = $this->get_list();

        $result['campaigns_count_min'] = $this->campaigns_count_min();
        $result['total_spendings_min'] = $this->total_spendings_min();
        $result['lw_spendings_min'] = $this->lw_spendings_min();
        $result['campaigns_count_max'] = $this->campaigns_count_max();
        $result['total_spendings_max'] = $this->total_spendings_max();
        $result['lw_spendings_max'] = $this->lw_spendings_max();
        return $result;
    }
}