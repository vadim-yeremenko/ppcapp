<?php

namespace App\Library;

use App\Library\CampaignsGet;
use App\Library\SpendingsGet;
use App\Library\ProductsGet;
use App\Spending;
use App\Click;
use App\Campaign;

class CalendarClass
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user()->id;
    }

    public function calendar_year($year)
    {
        $dates = array();

        date("L", mktime(0,0,0, 7,7, $year)) ? $days = 366 : $days = 365;
        for($i = 1; $i <= $days; $i++){
            $month = date('m', mktime(0,0,0,1,$i,$year));
            $wk = date('W', mktime(0,0,0,1,$i,$year));
            $wkDay = date('D', mktime(0,0,0,1,$i,$year));
            $day = date('d', mktime(0,0,0,1,$i,$year));

            $dates[$month][$wk][$wkDay] = $day;
        }

        return $dates;
    }

    /*
     *
     *  Function for adding missed days for week from previous month
     *
     * */
    private function previous_month_days($week_missing)
    {
        $return = '';
        for ($i = 1; $i <= $week_missing; $i++) {
            //$day = date()
            $return .= view('dashboard.partials.calendar-day')
                ->with('class', 'non-active')
                ->with('day', '')
                ->with('campaigns', 'n/a')
                ->with('campaigns_url', '')
                ->with('spendings', 'n/a')
                ->with('spendings_icon', '')
                ->with('clicks', 'n/a')
                ->with('clicks_icon', '');
        }
        return $return;
    }

    /*
     *
     * Function for adding missed days for week from next month
     *
     * */
    private function next_month_days($week_missing)
    {
        $return = '';
        for ($i = 1; $i <= $week_missing; $i++) {
            $return .= view('dashboard.partials.calendar-day')
                ->with('class', 'non-active')
                ->with('day', '')
                ->with('campaigns', 'n/a')
                ->with('campaigns_url', '')
                ->with('spendings', 'n/a')
                ->with('spendings_icon', '')
                ->with('clicks', 'n/a')
                ->with('clicks_icon', '')
                ->with('day', '');
        }
        return $return;
    }

    /*
     *
     * Show calendar function
     * */
    public function calendar_show($year, $month)
    {
        $return = '';
        $year_y = $year;
        $year = $this->calendar_year($year);
        $need_month = $year[$month];
        $week_index = 0;
        $week_count = count($need_month);
        foreach ($need_month as $week){
            $week_index ++;
            $days_count = count($week);
            $week_missing = 7 - $days_count;
            if($week_index == 1){
                /* Add missed days for week from previous month */
                $return .= $this->previous_month_days($week_missing);
            }
            /* All month */
            foreach($week as $day){
                $date = $year_y.'-'.$month.'-'.$day;
                $spendings = $this->get_spendings_by_day($date);
                $clicks = $this->get_clicks_by_day($date);
                $campaigns = $this->get_campaigns_by_day($date);
                $return .= view('dashboard.partials.calendar-day')
                    ->with('class', '')
                    ->with('day', $month.'/'.$day)
                    ->with('campaigns', $campaigns)
                    ->with('campaigns_url', '')
                    ->with('spendings', $spendings)
                    ->with('spendings_icon', $this->get_spendings_icon($date))
                    ->with('clicks', $clicks)
                    ->with('clicks_icon', $this->get_clicks_icon($date));
            }

            if($week_index == $week_count){
                /* Add missed days for week from next month */
                $return .= $this->next_month_days($week_missing);
            }
        }
        return $return;
    }


    /*
     *
     * Navigation functions for previous and next months
     *
     * */
    public function prev_month($year, $month){
        $next_month = '';
        $next_year = '';
        if($month == '01'){
            $next_year = (int)$year - 1;
            $next_month = 12;
        } else {
            $next_year = $year;
            $next_month = (int)$month - 1;
        }
        if($next_month < 10){
            $next_month = '0' . $next_month;
        }
        $return = route('calendar').'?year='.$next_year.'&month='.$next_month;
        return $return;
    }

    public function next_month($year, $month){
        $next_month = '';
        $next_year = '';
        if($month == '12'){
            $next_year = (int)$year + 1;
            $next_month = 1;
            if($next_month < 10){
                $next_month = '0' . $next_month;
            }
        } else {
            $next_year = $year;
            $next_month = (int)$month + 1;
            if($next_month < 10){
                $next_month = '0' . $next_month;
            }
        }
        $return = route('calendar').'?year='.$next_year.'&month='.$next_month;
        return $return;
    }

    private function get_spendings_by_day($day)
    {
        $return = 0;
        $spendings = Spending::orderBy('id', 'asc')
        ->where('user_id', $this->user)
        ->where('date', 'LIKE', $day.'%')
        ->get();
        foreach($spendings as $spending)
        {
            $return += $spending->value;
        }
        return $return;
    }

    private function get_clicks_by_day($day)
    {
        $return = 0;
        $clicks = Click::orderBy('id', 'asc')
            ->where('user_id', $this->user)
            ->where('date', 'LIKE', $day.'%')
            ->get();
        $return = count($clicks);
        return $return;
    }

    /* Previous day */
    private function get_spendings_by_prev_day($day)
    {
        $return = 0;
        $date = date("Y-m-d", strtotime('-1 day', strtotime($day)));
        $spendings = Spending::orderBy('id', 'asc')
            ->where('user_id', $this->user)
            ->where('date', 'LIKE', $date.'%')
            ->get();
        foreach($spendings as $spending)
        {
            $return += $spending->value;
        }
        return $return;
    }

    private function get_clicks_difference($day)
    {
        $today = $this->get_clicks_by_day($day);
        $tomorrow = $this->get_clicks_by_prev_day($day);
        $difference = $today - $tomorrow;
        return $difference;
    }

    private function get_spendings_difference($day)
    {
        $today = $this->get_spendings_by_day($day);
        $tomorrow = $this->get_spendings_by_prev_day($day);
        $difference = $today - $tomorrow;
        return $difference;
    }

    private function get_clicks_icon($day)
    {
        if($this->get_clicks_difference($day) < 0){
            return 'icon-grow-down';
        } else if($this->get_clicks_difference($day) > 0){
            return 'icon-grow-up';
        } else {
            return 'icon-none';
        }

    }

    private function get_spendings_icon($day)
    {
        if($this->get_spendings_difference($day) < 0){
            return 'icon-grow-down';
        } else if($this->get_spendings_difference($day) > 0){
            return 'icon-grow-up';
        } else {
            return 'icon-none';
        }
    }

    private function get_clicks_by_prev_day($day)
    {
        $return = 0;
        $date = date("Y-m-d", strtotime('-1 day', strtotime($day)));
        $clicks = Click::orderBy('id', 'asc')
            ->where('user_id', $this->user)
            ->where('date', 'LIKE', $date.'%')
            ->get();
        $return = count($clicks);
        return $return;
    }



    public function get_campaigns_by_day($day)
    {
        $return = 0;
        $campaigns = Campaign::orderBy('id', 'asc')
            ->where('user_id', $this->user)
            ->where('date', '>', $day.'%')
            ->where(function ($query) {
                $query->where('date_end', '<', '2019-11-20%')
                    ->orWhereNull('date_end');
            })
            //->where('date_end', '>=', $day.'%')
            ->get();
        $return = count($campaigns);
        return $return;
    }
}