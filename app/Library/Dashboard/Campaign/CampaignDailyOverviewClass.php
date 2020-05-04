<?php

/* Part of campaigns functions
 * Get daily overview list for campaign
 * */

namespace App\Library\Dashboard\Campaign;

use App\Campaign;
use App\Spending;
use App\Click;
use App\Library\ClicksGet;

class CampaignDailyOverviewClass
{
    protected $campaign;
    protected $spending;
    protected $clicks;
    protected $user;

    public function __construct()
    {
        $user_id = auth()->user();
        $this->user = $user_id->id;
    }

    /*
     * Get days array
     * */
    private function days_array()
    {
        $count = 30; // how many days list
        $d = array();
        for($i = 0; $i < $count; $i++)
            $d[] = date("Y-m-d", strtotime('-'. $i .' days'));
        return $d;
    }

    /*
     *
     * */

    private function get_day_spendings($day, $campaign)
    {
        $result = 0;
        $spendings = Spending::where('date', 'LIKE', $day.'%')
            ->where('user_id', '=', $this->user)
            ->where('campaign_id', '=', $campaign)
            ->get();
        foreach($spendings as $spending)
        {
            $result += $spending->value;
        }
        return $result;
    }

    private function get_day_clicks($day, $campaign)
    {
        return Click::where('created_at', 'LIKE', $day.'%')
            ->where('user_id', '=', $this->user)
            ->where('campaign_id', '=', $campaign)
            ->count();
    }

    /*
     *
     * */

    private function get_prev_day_spendings($day, $campaign)
    {
        $result = 0;
        $date = date("Y-m-d", strtotime('-1 day', strtotime($day)));
        $spendings = Spending::where('date', 'LIKE', $date.'%')
            ->where('user_id', '=', $this->user)
            ->where('campaign_id', '=', $campaign)
            ->get();
        foreach($spendings as $spending)
        {
            $result += $spending->value;
        }
        return $result;
    }

    private function get_prev_clicks($day, $campaign)
    {
        $date = date("Y-m-d", strtotime('-1 day', strtotime($day)));
        return Click::where('created_at', 'LIKE', $date.'%')
            ->where('user_id', '=', $this->user)
            ->where('campaign_id', '=', $campaign)
            ->count();
    }

    private function get_clicks_difference($day, $campaign)
    {
        $today = $this->get_day_clicks($day, $campaign);
        $tomorrow = $this->get_prev_clicks($day, $campaign);
        $difference = $today - $tomorrow;
        return $difference;
    }

    private function get_spendings_difference($day, $campaign)
    {
        $today = $this->get_day_spendings($day, $campaign);
        $tomorrow = $this->get_prev_day_spendings($day, $campaign);
        $difference = $today - $tomorrow;
        return $difference;
    }

    private function get_clicks_icon($day, $campaign)
    {
        if($this->get_clicks_difference($day, $campaign) < 0){
            return 'icon-grow-down';
        } else if($this->get_clicks_difference($day, $campaign) > 0){
            return 'icon-grow-up';
        } else {
            return 'icon-none';
        }

    }

    private function get_spendings_icon($day, $campaign)
    {
        if($this->get_spendings_difference($day, $campaign) < 0){
            return 'icon-grow-down';
        } else if($this->get_spendings_difference($day, $campaign) > 0){
            return 'icon-grow-up';
        } else {
            return 'icon-none';
        }
    }

    /*
     * Get list
     * */
    public function get_list($campaign)
    {
        $result = array();
        $days = array_slice($this->days_array(), 0, 5, true);
        foreach($days as $day){
            $result[$day]['date'] = date("m/d/Y", strtotime($day));
            $result[$day]['clicks'] = $this->get_day_clicks($day, $campaign);
            $result[$day]['clicks_icon'] = $this->get_clicks_icon($day, $campaign);
            $result[$day]['spendings'] = $this->get_day_spendings($day, $campaign);
            $result[$day]['spendings_icon'] = $this->get_spendings_icon($day, $campaign);
        }

        return $result;
    }

    public function get_full_list($campaign)
    {
        $result = array();
        $days = array_slice($this->days_array(), 0, 30, true);
        foreach($days as $day){
            $result[$day]['date'] = date("m/d/Y", strtotime($day));
            $result[$day]['clicks'] = $this->get_day_clicks($day, $campaign);
            $result[$day]['clicks_icon'] = $this->get_clicks_icon($day, $campaign);
            $result[$day]['spendings'] = $this->get_day_spendings($day, $campaign);
            $result[$day]['spendings_icon'] = $this->get_spendings_icon($day, $campaign);
        }

        return $result;
    }

    /* Values */

    public function click_min($campaign)
    {
        $array = $this->get_full_list($campaign);
        $min = 0;
        foreach( $array as $k => $v )
        {
            $min = min( array( $min, $v['clicks'] ) );
        }
        return $min;

    }

    public function click_max($campaign)
    {
        $array = $this->get_full_list($campaign);
        $max = 0;
        foreach( $array as $k => $v )
        {
            $max = max( array( $max, $v['clicks'] ) );
        }
        return $max;
    }

    public function spendings_min($campaign)
    {
        $array = $this->get_full_list($campaign);
        $min = 0;
        foreach( $array as $k => $v )
        {
            $min = min( array( $min, $v['spendings'] ) );
        }
        return $min;

    }

    public function spendings_max($campaign)
    {
        $array = $this->get_full_list($campaign);
        $max = 0;
        foreach( $array as $k => $v )
        {
            $max = max( array( $max, $v['spendings'] ) );
        }
        return $max;
    }
}