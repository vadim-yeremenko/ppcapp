<?php

namespace App\Library\Admin\Products;

use App\Library\CampaignsGet;
use App\Library\SpendingsGet;
use App\Subproduct;

class AdminProductsSubproductsClass
{
    public function __construct()
    {

    }
    /*
     * Get products list from DB
     *
     * */
    public function make_array()
    {
        $return = array();

        $products = \App\Product::orderBy('id', 'asc')
            ->get();

        $array = array();

        foreach ($products as $product){
            $array[$product->id]['type'] = 'product';
            $array[$product->id]['product_id'] = 0;
            $array[$product->id]['name'] = $product->name;
            $array[$product->id]['campaigns_count'] = $product->campaigns_count;
            $array[$product->id]['spendings_total'] = $product->spendings_total;
            $array[$product->id]['spendings_last_week'] = $product->spendings_last_week;
            $array[$product->id]['spendings_last_week_icon'] = $product->spendings_icon();
            $array[$product->id]['id'] = $product->id;

            if($product->fixcpc > 0){
                $array[$product->id]['mincpc'] = $product->fixcpc;
                $array[$product->id]['maxcpc'] = $product->fixcpc;
            } else {
                $array[$product->id]['mincpc'] = $product->mincpc;
                $array[$product->id]['maxcpc'] = $product->maxcpc;
            }
            $array[$product->id]['fixcpc'] = $product->fixcpc;
            $subproducts = Subproduct::orderBy('id', 'desc')->where('product_id', '=', $product->id)->get();
            if(count($subproducts) > 0) {
                $array[$product->id]['has_subproducts'] = true;
                $subproducts_count = count($subproducts);
                $idx = 0;
                foreach($subproducts as $subproduct) {
                    $idx++;
                    $array[$product->id.'-'.$subproduct->id]['idx'] = $idx;
                    $array[$product->id.'-'.$subproduct->id]['type'] = 'subproduct';
                    $array[$product->id.'-'.$subproduct->id]['product_id'] = $product->id;
                    $array[$product->id.'-'.$subproduct->id]['product_name'] = $product->name;
                    $array[$product->id.'-'.$subproduct->id]['name'] = $subproduct->name;
                    $array[$product->id.'-'.$subproduct->id]['campaigns_count'] = $subproduct->campaigns_count;
                    $array[$product->id.'-'.$subproduct->id]['spendings_total'] = $subproduct->spendings_total;
                    $array[$product->id.'-'.$subproduct->id]['spendings_last_week'] = $subproduct->spendings_last_week;
                    $array[$product->id.'-'.$subproduct->id]['spendings_last_week_icon'] = $subproduct->spendings_icon();
                    $array[$product->id.'-'.$subproduct->id]['id'] = $subproduct->id;
                    if($product->fixcpc > 0){
                        $array[$product->id.'-'.$subproduct->id]['mincpc'] = $product->fixcpc;
                        $array[$product->id.'-'.$subproduct->id]['maxcpc'] = $product->fixcpc;
                    } else {
                        $array[$product->id.'-'.$subproduct->id]['mincpc'] = $product->mincpc;
                        $array[$product->id.'-'.$subproduct->id]['maxcpc'] = $product->maxcpc;
                    }
                    $array[$product->id.'-'.$subproduct->id]['fixcpc'] = $subproduct->fixcpc;
                    if($subproducts_count == $idx){
                        $array[$product->id.'-'.$subproduct->id]['last'] = true;
                    } else {
                        $array[$product->id.'-'.$subproduct->id]['last'] = false;
                    }
                }
            } else {
                $array[$product->id]['has_subproducts'] = false;
            }
        }

        return $array;
    }
}