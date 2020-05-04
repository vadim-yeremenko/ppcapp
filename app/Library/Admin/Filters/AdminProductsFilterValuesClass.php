<?php

/*
 * Class for filtering users
 * using on Admin panel
 * */

namespace App\Library\Admin\Filters;

use App\Product;
use App\Spending;
use Illuminate\Support\Facades\DB;

class AdminProductsFilterValuesClass
{
    public function __construct()
    {

    }

    private function lw_spendings_min()
    {
        return Product::min('spendings_last_week');
    }

    private function lw_spendings_max()
    {
        return Product::max('spendings_last_week');
    }

    private function total_spendings_min()
    {
        return Product::min('spendings_total');
    }

    private function total_spendings_max()
    {
        return Product::max('spendings_total');
    }

    private function campaigns_min()
    {
        return Product::min('campaigns_count');
    }

    private function campaigns_max()
    {
        return Product::max('campaigns_count');
    }

    public function get_array()
    {
        $array = array(
            'lw_spendings_min' => round((int)$this->lw_spendings_min()),
            'lw_spendings_max' => round((int)$this->lw_spendings_max()),
            'total_spendings_min' => round((int)$this->total_spendings_min()),
            'total_spendings_max' => round((int)$this->total_spendings_max()),
            'campaigns_min' => round((int)$this->campaigns_min()),
            'campaigns_max' => round((int)$this->campaigns_max()),
        );

        return $array;
    }
}