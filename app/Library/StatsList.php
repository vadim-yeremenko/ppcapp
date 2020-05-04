<?php

namespace App\Library;

use \App\Library\ClicksGet;
use \App\Library\SpendingsGet;

class StatsList
{
    public function __construct()
    {

    }

    public function get_list_filtered()
    {

    }

    /*
     * Get min clicks for stats bar
     * */
    public function get_stats_week($user_id)
    {

        $clicks = new ClicksGet;
        $spendings = new SpendingsGet;

        $result = array();

        $timestamp = strtotime("-7 days");
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%Y-%m-%d', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        foreach ($days as $day){
            if($user_id == 'all'){
                $spendings = \App\Spending::orderBy('id', 'asc')
                    ->where('date', 'LIKE', $day.'%')
                    ->get();

                $clicks = \App\Click::orderBy('id', 'asc')
                    ->where('created_at', 'LIKE', $day.'%')
                    ->get();
            } else {
                $spendings = \App\Spending::orderBy('id', 'asc')
                    ->where('date', 'LIKE', $day.'%')
                    ->where('user_id', '=', $user_id)
                    ->get();

                $clicks = \App\Click::orderBy('id', 'asc')
                    ->where('created_at', 'LIKE', $day.'%')
                    ->where('user_id', '=', $user_id)
                    ->get();
            }

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

        $clicks = new ClicksGet;
        $spendings = new SpendingsGet;

        $result = array();

        $dates_input = explode(" - ", $request->dates);
        $campaign_input = $request->campaign;

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
                    $spendings = \App\Spending::orderBy('id', 'asc')
                        ->where('date', 'LIKE', $day.'%')
                        ->where('campaign_id', '=', $request->campaign)
                        ->get();
                    $clicks = \App\Click::orderBy('id', 'asc')
                        ->where('created_at', 'LIKE', $day.'%')
                        ->where('campaign_id', '=', $request->campaign)
                        ->get();
                } else {
                    $spendings = \App\Spending::orderBy('id', 'asc')
                        ->where('date', 'LIKE', $day.'%')
                        ->get();
                    $clicks = \App\Click::orderBy('id', 'asc')
                        ->where('created_at', 'LIKE', $day.'%')
                        ->get();
                }

            } else {
                $spendings = \App\Spending::orderBy('id', 'asc')
                    ->where('date', 'LIKE', $day.'%')
                    ->get();
                $clicks = \App\Click::orderBy('id', 'asc')
                    ->where('created_at', 'LIKE', $day.'%')
                    ->get();
            }


            $summary_spending = 0;
            foreach($spendings as $spending){
                $summary_spending += $spending->value;
            }
            $result[$day]['spendings'] = $summary_spending;


            $summary_clicks = count($clicks);

            $result[$day]['clicks'] = $summary_clicks;
            $result[$day]['date'] = date("m/d", strtotime($day));

        }


        $returnHTML = view('admin.partials.stats_items_after_filter')
            ->with('stats_week', $result)
            ->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }
}