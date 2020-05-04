<?php

/*
 * Class for filtering users
 * using on Admin panel
 * */

namespace App\Library\Admin\Filters;

use App\User;

class AdminUsersFilterValuesClass
{

    private function lw_spendings_min()
    {
        return User::min('spendings_last_week');
    }

    private function lw_spendings_max()
    {
        return User::max('spendings_last_week');
    }

    private function total_spendings_min()
    {
        return User::min('spendings_total');
    }

    private function total_spendings_max()
    {
        return User::max('spendings_total');
    }

    private function campaigns_min()
    {
        return User::min('campaigns_count');
    }

    private function campaigns_max()
    {
        return User::max('campaigns_count');
    }

    private function balance_min()
    {
        return User::min('balance');
    }

    private function balance_max()
    {
        return User::max('balance');
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
            'balance_min' => round((int)$this->balance_min()),
            'balance_max' => round((int)$this->balance_max()),
        );

        return $array;
    }
}