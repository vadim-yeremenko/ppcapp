<?php

/*
 * Class for stats graph for current logined user,
 * used on Dashboard
 * */

namespace App\Library\Dashboard\Common;

use App\Library\StatsList;

class StatsBarsGraphClass
{

    protected $user;
    protected $GetSpendingsClass; // get spendings class
    protected $GetClicksClass; // get clicks class

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
        // Spendings
        $this->GetSpendingsClass = new GetSpendingsClass();
        $this->GetClicksClass = new GetClicksClass();
    }

    /*
     * Get min clicks for stats bar
     * */
    public function get_stats_week()
    {
        $result = array();

        $timestamp = strtotime("-7 days");
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%Y-%m-%d', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        foreach ($days as $day){
            $spendings = $this->GetSpendingsClass->spendings_day($day);
            $clicks = $this->GetClicksClass->clicks_day($day);
            $summary_spending = 0;
            foreach($spendings as $spending){
                $summary_spending += $spending->value;
            }
            $result[$day]['spendings'] = $summary_spending;

            $summary_clicks = count($clicks);

            $result[$day]['clicks'] = $summary_clicks;
            $result[$day]['date'] = date("m/d", strtotime($day));
        }
        return $result;
    }

    /*
     * Get min clicks for stats bar
     * */
    public function get_min_clicks($array)
    {
        $clicks = array();

        foreach($array as $item)
        {
            $clicks[] = $item['clicks'];
        }

        return max($clicks);
    }

    /*
     * Get max clicks for stats bar
     * */
    public function get_max_clicks($array)
    {
        $clicks = array();

        foreach($array as $item)
        {
            $clicks[] = $item['clicks'];
        }

        return min($clicks);
    }

    /*
     * Get min clicks for stats bar
     * */
    public function get_stats_for_filter($request)
    {
        $result = array();
        $dates_input = explode(" - ", $request->dates);
        $Variable1 = strtotime($dates_input[0]);
        $Variable2 = strtotime($dates_input[1]);
        $dates_array = array();

        for ($currentDate = $Variable1; $currentDate <= $Variable2;
             $currentDate += (86400)) {

            $Store = date('Y-m-d', $currentDate);
            $dates_array[] = $Store;
        }

        foreach ($dates_array as $day){

            if(isset($request->campaign)){
                if($request->campaign != 'all'){
                    $spendings = $this->GetSpendingsClass->spendings_day_campaign($day, $request->campaign);
                    $clicks = $this->GetClicksClass->clicks_day_campaign($day, $request->campaign);
                } else {
                    $spendings = $this->GetSpendingsClass->spendings_day($day);
                    $clicks = $this->GetClicksClass->clicks_day($day);
                }

            } else {
                $spendings = $this->GetSpendingsClass->spendings_day($day);
                $clicks = $this->GetClicksClass->clicks_day($day);
            }
            $summary_spending = 0;
            foreach($spendings as $spending){
                $summary_spending += $spending->value;
            }
            $result[$day]['spendings'] = $summary_spending;
            $result[$day]['clicks'] = count($clicks);
            $result[$day]['date'] = date("m/d", strtotime($day));
        }

        $returnHTML = view('admin.partials.stats_items_after_filter')
            ->with('stats_week', $result)
            ->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }

    /*
     * ===========================================
     * Filter
     *
     * */

    public function get_request_data($request)
    {
        return $this->get_stats_for_filter($request);
    }
}