<?php

namespace App\Library;

class AdminDasboardStatsInfo
{
    protected $data;

    public function __construct()
    {

    }

    public function running_campaigns()
    {
        $campaigns = DB::table('campaigns')->where('is_active', 1);
        $campaings_count = count($campaigns);
        if($campaings_count == 1){
            $return = '1 campaign';
        } else {
            $return = $campaings_count.' campaigns';
        }
        return $return;
    }

    public function yesterday_spendings()
    {
        $yesterday = date('d.m.Y',strtotime("-1 days"));
        $previous_day = date('d.m.Y',strtotime("-2 days"));
        $spendings_previous_day = DB::table('spendings')->where('date', $previous_day);
        $spendings_yesterday = DB::table('spendings')->where('date', $yesterday);

        //return $return;
    }

    public function last_week_clicks()
    {

    }

    public function get_all()
    {

    }
}