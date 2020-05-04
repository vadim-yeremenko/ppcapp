<?php

/*
 * Class for clicks for all users,
 * used on Admin Control panel
 * */

namespace App\Library\Admin\Common;

use App\Click;

class AdminGetClicksClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    /*
     *
     * */

    public function clicks_day($day)
    {
        $clicks = \App\Click::orderBy('id', 'asc')
            ->where('created_at', 'LIKE', $day.'%')
            ->get();
        return $clicks;
    }

    public function clicks_day_campaign($day, $campaign)
    {
        $clicks = \App\Click::orderBy('id', 'asc')
            ->where('created_at', 'LIKE', $day.'%')
            ->where('campaign_id', 'LIKE', $campaign)
            ->get();
        return $clicks;
    }

    /* Get */
    public function get_list()
    {
        $clicks = Click::orderBy('id', 'asc')
            ->get();
        return $clicks;
    }

    // Last week clicks
    public function lw_clicks()
    {
        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->get();

        return count($clicks);
    }

    public function lw_clicks_prev()
    {
        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->get();

        return count($clicks);
    }

    public function lw_clicks_icon()
    {
        $value = $this->lw_clicks_difference();
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

    public function lw_clicks_difference()
    {
        $yesterday = $this->lw_clicks();
        $day_before = $this->lw_clicks_prev();
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

}