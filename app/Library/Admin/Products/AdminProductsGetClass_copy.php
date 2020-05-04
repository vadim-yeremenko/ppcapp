<?php
//
//namespace App\Library\Admin\Products;
//use App\Library\CampaignsGet;
//use App\Library\SpendingsGet;
//use App\Product;
//use App\Subproduct;
//
//class AdminProductsGetClass
//{
//    public function get_product_title($id)
//    {
//        $product = Product::orderBy('id', 'asc')
//            ->where('id', '=', $id)
//            ->first();
//        return $product->name;
//    }
//
//    public function get_subproducts_by_product($id, $limit = 5)
//    {
//        $product = Product::orderBy('id', 'asc')
//            ->where('id', '=', $id)
//            ->first();
//        $sub_products = Subproduct::where('product_id', '=', $id)->limit($limit)->offset(0)->get();
//        $campaigns = new CampaignsGet();
//        $spendings = new SpendingsGet();
//        if(count($sub_products) > 0){
//            foreach ($sub_products as $sub_product) {
//                $product->{'type'} = 'subproduct';
//                $sub_product->{'campaigns_count'} = $campaigns->get_campaigns($sub_product->id);
//                $sub_product->{'spendings_previous_week'} = $spendings->get_spendings_previous_week_by_subproduct($sub_product->id);
//                $sub_product->{'spendings_for_week'} = $spendings->get_spendings_for_week_by_subproduct($sub_product->id);
//                $sub_product->{'spendings_total'} = $spendings->get_spendings_total_by_subproduct($sub_product->id);
//                $sub_product->{'spendings_icon'} = $spendings->get_spendings_change_by_subproduct($sub_product->id);
//            }
//            $product->{'subproducts'} = $sub_products;
//        }
//
//        return $sub_products;
//    }
//    /*
//     * Get products list from DB
//     *
//     * */
//    public function get_from_db($per_page)
//    {
//        $return = array();
//
//        if(isset($per_page)){
//            $products = \App\Product::orderBy('id', 'asc')
//                ->limit($per_page)
//                ->get();
//        } else{
//            $products = \App\Product::orderBy('id', 'asc')
//                ->get();
//        }
//
//        $campaigns = new CampaignsGet;
//        $spendings = new SpendingsGet;
//        foreach($products as $product) {
//            $product->{'type'} = 'product';
//            $product->{'campaigns_count'} = $campaigns->get_campaigns($product->id);
//            $product->{'spendings_previous_week'} = $spendings->get_spendings_previous_week_by_product($product->id);
//            $product->{'spendings_for_week'} = $spendings->get_spendings_for_week_by_product($product->id);
//            $product->{'spendings_total'} = $spendings->get_spendings_total_by_product($product->id);
//            $product->{'spendings_icon'} = $spendings->get_spendings_change_by_product($product->id);
//            $sub_products = $product->sub_product()->get();
//
//            if(count($sub_products) > 0){
//                foreach ($sub_products as $sub_product) {
//                    $product->{'type'} = 'subproduct';
//                    $sub_product->{'campaigns_count'} = $campaigns->get_campaigns($sub_product->id);
//                    $sub_product->{'spendings_previous_week'} = $spendings->get_spendings_previous_week_by_subproduct($sub_product->id);
//                    $sub_product->{'spendings_for_week'} = $spendings->get_spendings_for_week_by_subproduct($sub_product->id);
//                    $sub_product->{'spendings_total'} = $spendings->get_spendings_total_by_subproduct($sub_product->id);
//                    $sub_product->{'spendings_icon'} = $spendings->get_spendings_change_by_subproduct($sub_product->id);
//                }
//                $product->{'subproducts'} = $sub_products;
//            }
//        }
//        $return = $products;
//        return $return;
//    }
//
//    public function get_product_by_id($id)
//    {
//        $product = \App\Product::orderBy('id', 'asc')
//            ->where('id', $id)
//            ->first();
//        return $product;
//    }
//
//    public function get_subproduct_by_id($id)
//    {
//        $product = \App\Subproduct::orderBy('id', 'asc')
//            ->where('id', $id)
//            ->first();
//        return $product;
//    }
//
//    /*
//     * Get list call
//     *
//     * */
//    public function get_list()
//    {
//        return $this->get_from_db('10000');
//    }
//
//    public function get_list_for_dashboard()
//    {
//        return $this->get_from_db('6');
//    }
//
//    /*
//     * Get product count
//     *
//     * */
//    public function get_count_products()
//    {
//        $products = \App\Product::orderBy('id', 'asc')
//            ->get();
//
//        return count($products);
//    }
//
//    /*
//     * Get subproduct count
//     *
//     * */
//    public function get_count_subproducts()
//    {
//        $subproducts = \App\Subproduct::orderBy('id', 'asc')
//            ->get();
//
//        return count($subproducts);
//    }
//
//    /*
//     * Get products list
//     *
//     * */
//    public function get_products_list()
//    {
//        $products = \App\Product::orderBy('id', 'asc')
//            ->get();
//        return $products;
//    }
//
//    /*
//     * Get subproducts list
//     *
//     * */
//    public function get_subproducts_list_by_product($product_id)
//    {
//        $products = \App\Subproduct::orderBy('name', 'asc')
//            ->where('product_id', '=', $product_id)
//            ->get();
//        return $products;
//    }
//
//    public function get_list_for_list()
//    {
//        $products = \App\Product::orderBy('id', 'asc')
//            ->get();
//        $campaigns = new CampaignsGet;
//        $spendings = new SpendingsGet;
//
//        foreach($products as $product) {
//            $product->{'type'} = 'product';
//            $product->{'campaigns_count'} = $campaigns->get_campaigns($product->id);
//            $product->{'spendings_previous_week'} = $spendings->get_spendings_previous_week_by_product($product->id);
//            $product->{'spendings_for_week'} = $spendings->get_spendings_for_week_by_product($product->id);
//            $product->{'spendings_total'} = $spendings->get_spendings_total_by_product($product->id);
//            $product->{'spendings_icon'} = $spendings->get_spendings_change_by_product($product->id);
//            $product->{'subproducts_count'} = $product->subproducts_count();
//            $sub_products = $product->sub_product()->get();
//        }
//        return $products;
//    }
//
//    public function get_subproduct_cpc_type($id)
//    {
//        $subproduct = \App\Subproduct::orderBy('id', 'asc')
//            ->where('id', '=', $id)
//            ->first();
//        if(!empty($subproduct->fixcpc)) {
//            $result = 'fixed';
//        } else {
//            $result = 'range';
//        }
//        return $result;
//    }
//
//    public function get_product_cpc_type($id)
//    {
//        $product = \App\Product::orderBy('id', 'asc')
//            ->where('id', '=', $id)
//            ->first();
//        if(!empty($product->fixcpc)) {
//            $result = 'fixed';
//        } else {
//            $result = 'range';
//        }
//        return $result;
//    }
//
//}