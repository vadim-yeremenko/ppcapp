<?php

/*
 * This class is using for all ajax requests like
 * pagination and filters on Admin panel
 * */

namespace App\Library\Admin\Ajax;

use App\Library\Admin\Filters\AdminProductsFilterValuesClass;
use App\Library\Admin\Filters\AdminUsersFilterValuesClass;
use App\Library\Admin\Products\AdminProductsGetClass;
use App\Library\Admin\Products\AdminUsersGetClass;
use App\Library\Admin\Users\AdminUsersListClass;
use App\Spending;

class AdminAjaxClass
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function run_ajax($request)
    {
        $action = $request->action;
        switch ($action) {

            case 'show_users':
                $return = $this->show_users();
                break;
            case 'show_products':
                $return = $this->show_products();
                break;
            default:
                $return = '';
                break;
        }
        return $return;
    }

    /*
     * Used for dashboard
     * Show products view
     * */
    public function show_products()
    {
        $AdminProductsGetClass = new AdminProductsGetClass();
        $products_list = $AdminProductsGetClass->get_products_list();
        // Products filter values
        $AdminProductsFilterValuesClass = new AdminProductsFilterValuesClass();
        $products_filter_values = $AdminProductsFilterValuesClass->get_array();
        /* Success result */
        $returnHTML = view('admin.main.dashboard_products')
            ->with('product_filter_val', $products_filter_values)
            ->with('products_list', $products_list)
            ->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    /*
     * Used for dashboard
     * Show users view
     * */
    public function show_users()
    {
        // Users list
        $AdminUsersGetClass = new AdminUsersGetClass();
        $users_list = $AdminUsersGetClass->get_users_list();
        // Products filter values
        $AdminUsersFilterValuesClass = new AdminUsersFilterValuesClass();
        $users_filter_values = $AdminUsersFilterValuesClass->get_array();
        /* Success result */
        $returnHTML = view('admin.main.dashboard_users')
            ->with('user_filter_val', $users_filter_values)
            ->with('users_list', $users_list)
            ->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }


}