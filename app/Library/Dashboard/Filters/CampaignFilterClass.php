<?php

/*
 * Class for filtering campaigns
 * */

namespace App\Library\Dashboard\Filters;
use App\Campaign;

class CampaignFilterClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    public function dashboard_filter($request)
    {
        //return $request;
        $CampaignFilterValuesClass = new CampaignFilterValuesClass();
        $default_values = $CampaignFilterValuesClass->get_array();

        if(isset($request->date)){
            $date = explode(' - ', $request->date);
            $date_min = date("Y-m-d h:i:s", strtotime($date['0']));
            $date_max = date("Y-m-d h:i:s", strtotime($date['1']));
        } else {
            $date_min = date("Y-m-d h:i:s", strtotime($default_values['max_date']));
            $date_max = date("Y-m-d h:i:s", strtotime($default_values['min_date']));
        }

        if(isset($request->spendings)){
            $spendings = explode(';', $request->spendings);
            $spendings_min = $spendings['0'];
            $spendings_max = $spendings['1'];
        } else {
            $spendings_min = $default_values['min_spendings'];
            $spendings_max = $default_values['max_spendings'];
        }

        if(isset($request->clicks)){
            $clicks = explode(';', $request->clicks);
            $clicks_min = $clicks['0'];
            $clicks_max = $clicks['1'];
        } else {
            $clicks_min = $default_values['min_clicks'];
            $clicks_max = $default_values['max_clicks'];
        }

        $campaigns = Campaign::orderBy('date', 'asc')
            ->where('user_id', '=', $this->user)
            ->whereBetween('date', [$date_min, $date_max])
            ->whereBetween('spendings_total', [$spendings_min, $spendings_max])
            ->whereBetween('clicks_total', [$clicks_min, $clicks_max])
            ->get();
        /* Success result */
        $returnHTML = view('dashboard.main.partials.campaign_item_ajax')->with('campaings', $campaigns)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function run_filter_page($request)
    {
        $CampaignFilterValuesClass = new CampaignFilterValuesClass();
        $default_values = $CampaignFilterValuesClass->get_array();

        if(isset($request->date)){
            $date = explode(' - ', $request->date);
            $date_min = date("Y-m-d h:i:s", strtotime($date['0']));
            $date_max = date("Y-m-d h:i:s", strtotime($date['1']));
        } else {
            $date_min = date("Y-m-d h:i:s", strtotime($default_values['max_date']));
            $date_max = date("Y-m-d h:i:s", strtotime($default_values['min_date']));
        }

        if(isset($request->spendings)){
            $spendings = explode(';', $request->spendings);
            $spendings_min = $spendings['0'];
            $spendings_max = $spendings['1'];
        } else {
            $spendings_min = $default_values['min_spendings'];
            $spendings_max = $default_values['max_spendings'];
        }

        if(isset($request->clicks)){
            $clicks = explode(';', $request->clicks);
            $clicks_min = $clicks['0'];
            $clicks_max = $clicks['1'];
        } else {
            $clicks_min = $default_values['min_clicks'];
            $clicks_max = $default_values['max_clicks'];
        }

        $campaigns = Campaign::orderBy('date', 'asc')
            ->where('user_id', '=', $this->user)
            ->whereBetween('date', [$date_min, $date_max])
            ->whereBetween('spendings_total', [$spendings_min, $spendings_max])
            ->whereBetween('clicks_total', [$clicks_min, $clicks_max])
            ->get();
        /* Success result */
        $returnHTML = view('dashboard.campaigns.partials.campaigns_list_ajax')->with('campaigns', $campaigns)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    /*
     * Method using for filer min value
     * */
    public function get_min_clicks()
    {

    }
}