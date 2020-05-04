<?php

namespace App\Library;

use App\Campaign;

class FilterCampaigns
{
    protected $income;

    public function __construct()
    {

    }

    public function filter_run($request)
    {
        $date = explode(' to ', $request->date);
        $date_min_value = $date['0'];
        $date_max_value = $date['1'];

        $product_id = $request->name;
        $campaign_spendings = $request->spendings;
        $campaign = Campaign::with('product_id', '=', $product_id);

        /* Success result */
        $returnHTML = view('dashboard.partials.ajax-campaign-result')->with('campaings', $campaign)->render();
        return response()->json(array('success' => true, 'html'=>$date));
    }

    public function filter_by_date($request)
    {

    }

}