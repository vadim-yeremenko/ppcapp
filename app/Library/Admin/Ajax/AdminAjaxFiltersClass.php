<?php

/*
 * This class is using for all ajax requests like
 * pagination and filters on Admin panel
 * */

namespace App\Library\Admin\Ajax;

use App\Library\Admin\Filters\AdminFilterCampaignsClass;
use App\Library\Admin\Filters\AdminFilterCampaignsUsersClass;
use App\Library\Admin\Filters\AdminFilterUsersClass;
use App\Library\Admin\Filters\AdminProductsFilterClass;
use App\Library\Admin\Filters\AdminProductSubproductFilterClass;
use App\Library\Admin\Filters\AdminUsersFilterValuesClass;

class AdminAjaxFiltersClass
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /*
     * Main start ajax function
     * */
    public function run_ajax($request)
    {
        $action = $request->action;
        switch ($action) {

            case 'filter_products_dashboard':
                $return = $this->filter_products_dashboard();
                break;

            case 'filter_users_dashboard':
                $return = $this->filter_users_dashboard();
                break;

            case 'filter_users':
                $return = $this->filter_users();
                break;

            case 'filter_products_subproducts':
                $return = $this->filter_products_subproducts();
                break;

            default:
                $return = '';
                break;
        }
        return $return;
    }

    /*
    * Filter products
    * */
    public function filter_products_dashboard()
    {
        $AdminProductsFilterClass = new AdminProductsFilterClass();
        return $AdminProductsFilterClass->run_filter($this->request);
    }

    /*
    * Filter users
    * */

    public function filter_users_dashboard()
    {
        $AdminFilterUsersClass = new AdminFilterUsersClass();
        return $AdminFilterUsersClass->run_filter($this->request);
    }

    public function filter_users()
    {
        $AdminFilterUsersClass = new AdminFilterUsersClass();
        return $AdminFilterUsersClass->run_filter_page($this->request);
    }

    public function filter_products_subproducts()
    {
        $AdminProductSubproductFilterClass = new AdminProductSubproductFilterClass();
        return $AdminProductSubproductFilterClass->run_filter($this->request);
    }

}