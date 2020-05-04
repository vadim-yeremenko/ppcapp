<?php

/*
 * Class for spendings for current login user,
 * used on Admin control panel
 * */

namespace App\Library\Dashboard\Common;

use App\Spending;

class GetSpendingsClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    /* ===============================
     * Get all spendings by user by date (for one day)
     * Used on stats for example
     * */

    public function spendings_day($day)
    {
        $spendings = Spending::orderBy('id', 'asc')
            ->where('date', 'LIKE', $day.'%')
            ->where('user_id', 'LIKE', $this->user)
            ->get();
        return $spendings;
    }

    public function spendings_day_campaign($day, $campaign)
    {
        $spendings = Spending::orderBy('id', 'asc')
            ->where('date', 'LIKE', $day.'%')
            ->where('user_id', 'LIKE', $this->user)
            ->where('campaign_id', 'LIKE', $campaign)
            ->get();
        return $spendings;
    }

    /* ==============================
     * Spendings statistics by user_id
     * required $user_id
     * */
    public function lw_spendings()
    {
        $first_date = date("Y-m-d", strtotime("-6 days"));
        $last_date = date("Y-m-d", strtotime("today"));
        $spendings = Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$first_date, $last_date])
            ->where('user_id', $this->user)
            ->get();
        $summary = 0;
        foreach($spendings as $spending){
            $summary += (int)$spending->value;
        }
        return $summary;
    }

    public function lw_spendings_prev()
    {
        $first_date = date("Y-m-d", strtotime("-2 weeks"));
        $last_date = date("Y-m-d", strtotime("-1 week"));
        $spendings = Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$first_date, $last_date])
            ->where('user_id', $this->user)
            ->get();
        $sumary = 0;
        foreach($spendings as $spending){
            $sumary += (int)$spending->value;
        }
        return $sumary;
    }

    public function lw_spendings_difference()
    {
        $yesterday = $this->lw_spendings();
        $day_before = $this->lw_spendings_prev();

        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

    public function lw_spendings_icon()
    {
        $value = $this->lw_spendings_difference();
        $value = str_replace('%', '', $value);
        if($value < 0){
            $return = 'change-down';
        } else if($value == 0){
            $return = 'change-none';
        } else {
            $return = 'change-up';
        }

        return $return;
    }
}