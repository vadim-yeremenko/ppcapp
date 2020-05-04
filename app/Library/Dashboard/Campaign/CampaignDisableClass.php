<?php

/*
 * Campaign will be disabled using this class
 *
 * */

namespace App\Library\Dashboard\Campaign;

use App\Campaign;

class CampaignDisableClass
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;

    }

    /*
     * Run
     * */
    public function run()
    {
        $user_id = auth()->user();
        $user_id = $user_id->id;
        $campaign = Campaign::where('id', 'LIKE', $this->request->id)->first();
        if($campaign->user_id == $user_id){
            return $this->disabling();
        } else {
            return $this->not_author();
        }
    }

    /*
     * Disable
     *
     * */
    public function disabling()
    {
        $request = $this->request;
        $campaign = Campaign::where('id', 'LIKE', $request->id)->first();
        $campaign->is_active = '0';
        $campaign->save();
        $returnHTML = view('dashboard.campaign-disabled')->with('campaign', $campaign)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    /*
     * If user not author
     *
     * */
    public function not_author()
    {
        return response()->json(array('success' => false, 'html'=>'Error'));
    }
}