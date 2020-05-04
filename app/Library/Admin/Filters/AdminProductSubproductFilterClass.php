<?php

namespace App\Library\Admin\Filters;

use App\Library\Admin\Products\AdminProductsSubproductsClass;
use App\Product;
use App\Subproduct;

class AdminProductSubproductFilterClass
{
    public function get_array()
    {
        $AdminProductsSubproductsClass = new AdminProductsSubproductsClass();
        $array = $AdminProductsSubproductsClass->make_array();
        return $array;
    }
    public function run_filter($request)
    {
        // Filter values
        $AdminProductSubproductFilterValuesClass = new AdminProductSubproductFilterValuesClass();
        $default_values = $AdminProductSubproductFilterValuesClass->get_array();

        if(isset($request->sorting)){
            $sorting = explode('-', $request->sorting);
            $order_by_field = $sorting[0];
            $order_by_asc = $sorting[1];
        } else {
            $order_by_field = 'id';
            $order_by_asc = 'asc';
        }

        if(isset($request->lw_spendings)){
            $spendings = explode(';', $request->lw_spendings);
            $lw_spendings_min = $spendings['0'];
            $lw_spendings_max = $spendings['1'];
        } else {
            $lw_spendings_min = $default_values['lw_spendings_min'];
            $lw_spendings_max = $default_values['lw_spendings_max'];
        }
        if(isset($request->total_spendings)){
            $spendings = explode(';', $request->total_spendings);
            $total_spendings_min = $spendings['0'];
            $total_spendings_max = $spendings['1'];
        } else {
            $total_spendings_min = $default_values['total_spendings_min'];
            $total_spendings_max = $default_values['total_spendings_max'];
        }
        if(isset($request->campaigns_count)){
            $campaigns = explode(';', $request->campaigns_count);
            $campaigns_min = $campaigns['0'];
            $campaigns_max = $campaigns['1'];
        } else {
            $campaigns_min = $default_values['campaigns_count_min'];
            $campaigns_max = $default_values['campaigns_count_max'];
        }

        $products = Product::orderBy($order_by_field, $order_by_asc)
            ->whereBetween('campaigns_count', [$campaigns_min, $campaigns_max])
            ->whereBetween('spendings_total', [$total_spendings_min, $total_spendings_max])
            ->whereBetween('spendings_last_week', [$lw_spendings_min, $lw_spendings_max])
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
            $subproducts = Subproduct::orderBy($order_by_field, $order_by_asc)
                ->where('product_id', '=', $product->id)
                ->whereBetween('campaigns_count', [$campaigns_min, $campaigns_max])
                ->whereBetween('spendings_total', [$total_spendings_min, $total_spendings_max])
                ->whereBetween('spendings_last_week', [$lw_spendings_min, $lw_spendings_max])
                ->get();
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

        //return $array;
        //$array = $this->get_array();

//        foreach($array as $id => $item){
//            if(
//                $item['campaigns_count'] >= $campaigns_count_min
//                && $item['campaigns_count'] <= $campaigns_count_max
//                && $item['spendings_total'] >= $total_spendings_min
//                && $item['spendings_total'] <= $total_spendings_max
//                && $item['spendings_last_week'] >= $lw_spendings_min
//                && $item['spendings_last_week'] <= $lw_spendings_max
//            ){
//                $result[$id] = $item;
//            }
//        }

        /* Success result */
        $returnHTML = view('admin.partials.products_subproducts_list')->with('products_array', $array)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}