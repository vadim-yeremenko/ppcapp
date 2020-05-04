<?php

/*
 * Class for admin panel
 * Show main statistics on top of main page
 * */

namespace App\Library\Admin\Main;


use App\Library\Admin\Campaign\AdminCampaignsListClass;
use App\Library\Admin\Common\AdminGetClicksClass;
use App\Library\Admin\Common\AdminGetSpendingsClass;

class AdminStatisticsClass
{
    public function __construct()
    {

    }

    public function running_campaigns()
    {
        $campaigns = new AdminCampaignsListClass();
        return count($campaigns->active_campaigns(1000));
    }

    public function lw_spendings()
    {
        $return = array();
        $spendings = new AdminGetSpendingsClass();
        $return['count'] = $spendings->lw_spendings();
        $return['difference'] = $spendings->lw_spendings_difference();
        $return['icon'] = $spendings->lw_spendings_icon();
        return $return;
    }

    public function lw_clicks()
    {
        $return = array();
        $clicks = new AdminGetClicksClass();
        $return['count'] = $clicks->lw_clicks();
        $return['difference'] = $clicks->lw_clicks_difference();
        $return['icon'] = $clicks->lw_clicks_icon();
        return $return;
    }

    public function get_list()
    {
        $return = array();

        return $return;
    }
}