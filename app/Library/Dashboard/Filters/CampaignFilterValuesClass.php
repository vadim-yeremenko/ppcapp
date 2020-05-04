<?php

/*
 * Class for getting values for filter parameters
 * for Campaign filter
 * */

namespace App\Library\Dashboard\Filters;
use App\Campaign;
use Illuminate\Support\Facades\DB;

class CampaignFilterValuesClass
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
    public function get_min_date()
    {
        $min_date = DB::table('campaigns')->where('user_id', '=', $this->user)->min('date');
        return $min_date;
    }

    /*
     * Method using for filer min value  total clicks
     * */
    public function get_max_date()
    {
        $max_date = DB::table('campaigns')
            ->where('user_id', '=', $this->user)
            ->where('is_active', '=', 1)
            ->max('date');
        return $max_date;
    }

    /*
     * Method using for filer min value  total clicks
     * */
    public function get_min_clicks()
    {
        $min_clicks = DB::table('campaigns')
            ->where('user_id', '=', $this->user)
            ->where('is_active', '=', 1)
            ->min('clicks_total');
        return $min_clicks;
    }

    /*
     * Method using for filer max value total clicks
     * */
    public function get_max_clicks()
    {
        $max_clicks = DB::table('campaigns')
            ->where('user_id', '=', $this->user)
            ->where('is_active', '=', 1)
            ->max('clicks_total');
        return $max_clicks;
    }

    /*
     * Method using for filer max value total clicks
     * */
    public function get_min_spendings()
    {
        $min_clicks = DB::table('campaigns')
            ->where('user_id', '=', $this->user)
            ->where('is_active', '=', 1)
            ->min('spendings_total');
        return $min_clicks;
    }

    /*
     * Method using for filer max value total clicks
     * */
    public function get_max_spendings()
    {
        $max_clicks = DB::table('campaigns')
            ->where('user_id', '=', $this->user)
            ->where('is_active', '=', 1)
            ->max('spendings_total');
        return $max_clicks;
    }

    public function get_array()
    {
        $return = array();
        $return['min_clicks'] = $this->get_min_clicks();
        $return['max_clicks'] = $this->get_max_clicks();
        $return['min_spendings'] = $this->get_min_spendings();
        $return['max_spendings'] = $this->get_max_spendings();
        $return['max_date'] = $this->get_max_date();
        $return['min_date'] = $this->get_min_date();
        return $return;
    }
}