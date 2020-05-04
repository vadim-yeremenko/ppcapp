<?php

/*
 * Class for filtering users
 * using on Admin panel
 * */

namespace App\Library\Admin\Filters;

use App\Product;
use App\User;

class AdminFilterUsersClass
{
    public function run_filter($request)
    {
        $AdminProductsFilterValuesClass = new AdminProductsFilterValuesClass();
        $default_values = $AdminProductsFilterValuesClass->get_array();

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

        if(isset($request->campaigns)){
            $clicks = explode(';', $request->campaigns);
            $campaigns_min = $clicks['0'];
            $campaigns_max = $clicks['1'];
        } else {
            $campaigns_min = $default_values['campaigns_max'];
            $campaigns_max = $default_values['campaigns_min'];
        }


        if(isset($request->sorting)){
            $sorting = explode('-', $request->sorting);
            $order_by_field = $sorting[0];
            $order_by_asc = $sorting[1];
        } else {
            $order_by_field = 'id';
            $order_by_asc = 'asc';
        }

        $users_list = User::orderBy($order_by_field, $order_by_asc)
            ->whereBetween('campaigns_count', [$campaigns_min, $campaigns_max])
            ->whereBetween('spendings_total', [$total_spendings_min, $total_spendings_max])
            ->whereBetween('spendings_last_week', [$lw_spendings_min, $lw_spendings_max])
            ->where('active', '=', '1')
            ->role('customer')
            ->limit(6)
            ->get();
        /* Success result */
        $returnHTML = view('admin.partials.users_list')->with('users_list', $users_list)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML, 'more_btn_url' => $this->filter_redirect($request)));
    }

    public function run_filter_page($request)
    {
        $AdminProductsFilterValuesClass = new AdminProductsFilterValuesClass();
        $default_values = $AdminProductsFilterValuesClass->get_array();

        $length = 10;
        $length_value = 10;

        $items_count = $length;
        $pagination_num = 2;

        if(isset($request->pagination)){
            $pagination = (int)$request->pagination;
            if($pagination > 1){
                $length = $length * $pagination;
            }
            $pagination_num = $pagination+1;
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

        if(isset($request->campaigns)){
            $clicks = explode(';', $request->campaigns);
            $campaigns_min = $clicks['0'];
            $campaigns_max = $clicks['1'];
        } else {
            $campaigns_min = $default_values['campaigns_max'];
            $campaigns_max = $default_values['campaigns_min'];
        }

        if(isset($request->sorting)){
            $sorting = explode('-', $request->sorting);
            $order_by_field = $sorting[0];
            $order_by_asc = $sorting[1];
        } else {
            $order_by_field = 'id';
            $order_by_asc = 'asc';
        }

        $items_count = User::orderBy($order_by_field, $order_by_asc)
            ->whereBetween('campaigns_count', [$campaigns_min, $campaigns_max])
            ->whereBetween('spendings_total', [$total_spendings_min, $total_spendings_max])
            ->whereBetween('spendings_last_week', [$lw_spendings_min, $lw_spendings_max])
            ->where('active', '!=', 0)
            ->role('customer')
            ->count();

        $users_list = User::orderBy($order_by_field, $order_by_asc)
            ->whereBetween('campaigns_count', [$campaigns_min, $campaigns_max])
            ->whereBetween('spendings_total', [$total_spendings_min, $total_spendings_max])
            ->whereBetween('spendings_last_week', [$lw_spendings_min, $lw_spendings_max])
            ->where('active', '!=', 0)
            ->role('customer')
            ->limit($length)
            ->get();

        if($items_count >= $length_value * $pagination_num){
            $pagination_end = false;
        } else {
            $pagination_end = true;
        }

        /* Success result */
        $returnHTML = view('admin.users.users_list')->with('users_list', $users_list)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML, 'pagination'=>$pagination_num, 'pagination_end' => $pagination_end));
    }

    // Legacy function
    public function filter_redirect($request)
    {
        $data['sorting'] = $request->sorting;
        $data['lw_spendings_min'] = $this->prepare_data($request->lw_spendings)[0];
        $data['lw_spendings_max'] = $this->prepare_data($request->lw_spendings)[1];
        $data['total_spendings_min'] = $this->prepare_data($request->total_spendings)[0];
        $data['total_spendings_max'] = $this->prepare_data($request->total_spendings)[1];
        $data['campaigns_min'] = $this->prepare_data($request->campaigns)[0];
        $data['campaigns_max'] = $this->prepare_data($request->campaigns)[1];

        $url = route('products-list').'?'.http_build_query($data);
        return $url;
    }

    public function prepare_data($data)
    {
        $array = explode(';', $data);
        return $array;
    }
}