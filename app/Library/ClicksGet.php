<?php
/*
 * Main Clicks controller
 *
 * */
namespace App\Library;

use App\Click;

class ClicksGet
{

    public function __construct()
    {

    }

    public function get_list()
    {
        $clicks = Click::orderBy('id', 'asc')
            ->get();
        return $clicks;
    }


    /*
     * ======================== COMMON =======================
     * */
    public function get_all_clicks_last_week()
    {
        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->get();

        return count($clicks);
    }

    public function get_all_clicks_previous_week()
    {
        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->get();

        return count($clicks);
    }

    public function get_all_clicks_last_week_icon()
    {
        $value = $this->get_all_clicks_last_week_difference();
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

    public function get_all_clicks_last_week_difference()
    {
        $yesterday = $this->get_all_clicks_last_week();
        $day_before = $this->get_all_clicks_previous_week();
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

    /*
     * ============================ USER ========================
     * Clicks for user
     * */
    public function get_clicks_last_week_user($id)
    {
        if(empty($id))
            return '';

        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->where('user_id', $id)
            ->get();

        return count($clicks);
    }

    public function get_clicks_previous_week_user($id)
    {
        if(empty($id))
            return '';

        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->where('user_id', $id)
            ->get();

        return count($clicks);
    }

    public function get_clicks_last_week_icon_user($id)
    {
        if(empty($id))
            return '';

        $value = $this->get_clicks_last_week_difference_user($id);
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

    public function get_clicks_last_week_difference_user($id)
    {
        $yesterday = $this->get_clicks_last_week_user($id);
        $day_before = $this->get_clicks_previous_week_user($id);
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

    /* ========================== Campaign ===============================
    *
    */

    public function get_clicks_by_campaign($id, $day = null)
    {
//        if($day){
//            $clicks = Click::orderBy('id', 'asc')
//                ->where('created_at', 'like', $day.'%')
//                ->where('campaign_id', $id)
//                ->count();
//        } else {
//            $clicks = Click::orderBy('id', 'asc')
//                ->where('created_at', 'like', $day.'%')
//                ->where('campaign_id', $id)
//                ->count();
//        }
//        return $clicks;
    }

    /*
     * Count difference by campaign
     * */

    public function get_clicks_by_campaign_day_difference()
    {

    }

    /*
     * Count difference by campaign
     * */

    public function get_clicks_by_campaign_day_previous()
    {

    }

    /*
     * Use icon
     * */

    public function get_clicks_by_campaign_day_icon()
    {

    }
}