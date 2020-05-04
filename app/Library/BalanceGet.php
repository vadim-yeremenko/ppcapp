<?php

namespace App\Library;

use \App\Spending;

class BalanceGet
{
    public function __construct()
    {

    }

    /* ==============================  All for SPENDINGS ===============
     * Get spendings for a week
     *
     * */
    public function get_spendings_for_week()
    {

        $first_day = date("Y-m-d h:i:s", strtotime("-1 week"));
        $last_day = date("Y-m-d h:i:s");

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     *
     * for previous week for label (it was grow up or down)
     *
     * */

    public function get_spendings_previous_week()
    {

        $first_day = date("Y-m-d h:i:s", strtotime("-2 week"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 week"));

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Add icon depend how was changed
     * */
    public function get_spendings_change()
    {
        $last_week = $this->get_spendings_for_week();
        $previuos_week = $this->get_spendings_previous_week();
        if($last_week > $previuos_week){
            return 'change-up';
        } else if ($previuos_week > $last_week) {
            return 'change-down';
        } else {
            return 'hidden';
        }
    }

    /* Just count difference in percents */
    public function get_spendings_difference()
    {

        $yesterday = $this->get_spendings_for_week();
        $day_before = $this->get_spendings_previous_week();

        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }

    }

    public function users_spendings_graph()
    {
        $result = array();
        $timestamp = strtotime("-7 days");
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%Y-%m-%d', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        foreach ($days as $day){
            $spendings = \App\Spending::orderBy('id', 'asc')
                ->where('date', 'LIKE', $day.'%')
                ->get();

            $summary_spending = 0;
            foreach($spendings as $spending){
                $summary_spending += $spending->value;
            }
            $result[] = $summary_spending;
        }
        return $result;
    }

    /* Average CPC for a week */
    public function get_average_cpc()
    {
        $clicks = new ClicksGet();

        $week_spendings = $this->get_spendings_for_week();
        $week_clicks = $clicks->get_all_clicks_last_week();

        if($week_clicks != 0 && $week_spendings != 0){
            $av_cpc = $week_spendings / $week_clicks;
        } else {
            $av_cpc = false;
        }


        if($av_cpc){
            $result = round($av_cpc, 2);
        } else {
            $result = '';
        }

        return $result;
    }

    /* =======================  All for CHARGES ======================
     * ===============================================================
     * Get spendings for a week
     *
     * */
    public function get_charges_for_week()
    {

        $first_day = date("Y-m-d h:i:s", strtotime("-1 week"));
        $last_day = date("Y-m-d h:i:s");

        $spendings = \App\Charge::orderBy('id', 'asc')
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     *
     * for previous week for label (it was grow up or down)
     *
     * */

    public function get_charges_previous_week()
    {

        $first_day = date("Y-m-d h:i:s", strtotime("-2 week"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 week"));

        $spendings = \App\Charge::orderBy('id', 'asc')
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }

    /*
     * Add icon depend how was changed values for subprduct
     * */
    public function get_charges_change()
    {
        $last_week = $this->get_spendings_for_week();
        $previuos_week = $this->get_spendings_previous_week();
        if($last_week > $previuos_week){
            return 'change-up';
        } else if ($previuos_week > $last_week) {
            return 'change-down';
        } else {
            return 'hidden';
        }
    }

    public function get_charges_difference()
    {

        $yesterday = $this->get_charges_for_week();
        $day_before = $this->get_charges_previous_week();

        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }

    }

    public function users_charges_graph()
    {
        $result = array();
        $timestamp = strtotime("-7 days");
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%Y-%m-%d', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        foreach ($days as $day){
            $spendings = \App\Charge::orderBy('id', 'asc')
                ->where('date', 'LIKE', $day.'%')
                ->get();
            $summary_spending = 0;
            foreach($spendings as $spending){
                $summary_spending += $spending->value;
            }
            $result[] = $summary_spending;
        }
        return $result;
    }


    /* =========================== FOR USER =========================
     *
     * */
    public function get_balance_by_user($id)
    {
        $user = \App\User::orderBy('id', 'asc')
            ->where('id', '=', $id)
            ->first();

        return $user->balance;
    }

    public function get_user_last_charge($id)
    {
        $result = array();
        $charges = \App\Charge::orderBy('id', 'asc')
            ->where('user_id', '=', $id)
            ->latest()
            ->first();
        if(!empty($charges)){
            $date = $charges->date;
            $newDate = date("m/d/Y", strtotime($date));

            $result['date'] = $newDate;
            $result['amount'] = $charges->value;
        } else {
            $result['date'] = '';
            $result['amount'] = '';
        }

        return $result;
    }

    public function get_charges_list_user($id)
    {
        $first_day = date("Y-m-d h:i:s", strtotime("-1 week"));
        $last_day = date("Y-m-d h:i:s");

        $spendings = \App\Charge::orderBy('id', 'asc')
            ->whereBetween('date', [$first_day, $last_day])
            ->where('user_id', $id)
            ->take(7)
            ->get();
        return $spendings;
    }
}