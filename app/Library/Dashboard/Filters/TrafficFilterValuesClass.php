<?php

/*
 * Class for getting values for filter parameters
 * for Traffic sources filter
 * */

namespace App\Library\Dashboard\Filters;
use App\Campaign;
use App\Library\Dashboard\Campaign\CampaignTrafficSourceClass;
use Illuminate\Support\Facades\DB;

class TrafficFilterValuesClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    /*
     * Method using for filer min value  total clicks
     * */
    public function get_min_clicks($id)
    {
        $traffic_list = new CampaignTrafficSourceClass($id);
        $min_clicks = $traffic_list->traffic_click_min();
        return $min_clicks;
    }

    /*
     * Method using for filer max value  total clicks
     * */
    public function get_max_clicks($id)
    {
        $traffic_list = new CampaignTrafficSourceClass($id);
        $min_clicks = $traffic_list->traffic_click_max();
        return $min_clicks;
    }

    /*
     * Method using for filer max value total spendings
     * */
    public function get_max_spendings($id)
    {
        $traffic_list = new CampaignTrafficSourceClass($id);
        $min_clicks = $traffic_list->traffic_spendings_max();
        return $min_clicks;
    }

    /*
    * Method using for filer min spendings
    * */
    public function get_min_spendings($id)
    {
        $traffic_list = new CampaignTrafficSourceClass($id);
        $min_clicks = $traffic_list->traffic_spendings_min();
        return $min_clicks;
    }

    public function get_total_traffic($id)
    {
        $traffic_list = new CampaignTrafficSourceClass($id);
        $total_count = count($traffic_list->traffic_list());
        return $total_count;
    }

    public function get_array($id)
    {
        $return = array();
        $return['min_clicks'] = $this->get_min_clicks($id);
        $return['max_clicks'] = $this->get_max_clicks($id);
        $return['min_spendings'] = $this->get_min_spendings($id);
        $return['max_spendings'] = $this->get_max_spendings($id);
        $return['total_count'] = $this->get_total_traffic($id);
        return $return;
    }
}