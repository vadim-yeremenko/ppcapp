<?php

/*
 * Class for getting values for filter parameters
 * for Daily overview filter
 * */

namespace App\Library\Dashboard\Filters;

use App\Library\Dashboard\Campaign\CampaignDailyOverviewClass;

class DailyOverviewFilterValuesClass
{
    public function __construct()
    {

    }

    public function get_list($campaign)
    {
        $listClass = new CampaignDailyOverviewClass();
        return $listClass->get_full_list($campaign);
    }

    public function get_array($campaign)
    {
        $listClass = new CampaignDailyOverviewClass();
        $result = array();
        $list = $this->get_list($campaign);
        $result['total_count'] = count($list);
        $result['min_clicks'] = $listClass->click_min($campaign);
        $result['max_clicks'] = $listClass->click_max($campaign);
        $result['min_spendings'] = $listClass->spendings_min($campaign);
        $result['max_spendings'] = $listClass->spendings_max($campaign);
        return $result;
    }
}