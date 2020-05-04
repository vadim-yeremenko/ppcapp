<?php

namespace App\Library\Dashboard\Main;

use App\Library\Dashboard\Campaign\CampaignsListClass;
use App\Library\Dashboard\Common\GetClicksClass;
use App\Library\Dashboard\Common\GetSpendingsClass;

class DashboardStatisticsClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    public function running_campaigns()
    {
        $campaigns = new CampaignsListClass();
        return count($campaigns->active_campaigns(1000));
    }

    public function lw_spendings()
    {
        $return = array();
        $spendings = new GetSpendingsClass();
        $return['count'] = $spendings->lw_spendings();
        $return['difference'] = $spendings->lw_spendings_difference();
        $return['icon'] = $spendings->lw_spendings_icon();
        return $return;
    }

    public function lw_clicks()
    {
        $return = array();
        $clicks = new GetClicksClass();
        $return['count'] = $clicks->lw_clicks();
        $return['difference'] = $clicks->lw_clicks_difference();
        $return['icon'] = $clicks->lw_clicks_icon();
        return $return;
    }
}