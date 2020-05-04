<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    /*
     * Database relations
     *
     * */
    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function subproduct()
    {
        return $this->hasOne(Subproduct::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function get_spendings_count()
    {
        return $this->hasMany(Spending::class)->count();
    }

    /*
     * Spendings
     *
     * */

    public function get_spendings_summ(){
        $summ = 0;
        $spendings = Spending::where('campaign_id', '=', $this->id)->get();
        foreach($spendings as $spending)
        {
            $summ += $spending->value;
        }
        return number_format($summ, 2, '.', ',');
    }

    public function get_spendings_average(){
        $summ = $this->get_spendings_summ();
        $count = $this->get_spendings_count();
        if(!empty($summ) && !empty($count)){
            $result = $summ / $count;
        } else {
            $result = 0;
        }

        return number_format($result, 2, '.', ',');
    }

    public function get_clicks_count()
    {
        $clicks = \App\Spending::orderBy('id', 'asc')
            ->where('campaign_id', $this->id)
            ->get();

        return count($clicks);
    }

    public function spendings_summ()
    {
        $summ = 0;
        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('campaign_id', $this->id)
            ->get();
        foreach($spendings as $spending)
        {
            $summ += $spending->value;
        }
        return $summ;
    }

    /*
     * Dates modifications
     * */
    public function modified_date()
    {
        $date = $this->date;
        $modified_date = date("m/d/Y", strtotime($date));
        return $modified_date;
    }

    public function modified_day_date()
    {
        $date = $this->date;
        $modified_date = date("l, m/d/Y", strtotime($date));
        return $modified_date;
    }

    public function modified_full_date()
    {
        $date = $this->date;
        $modified_date = date("l, dS", strtotime($date)) . ' of ' . date("F Y", strtotime($date));
        return $modified_date;
    }

    /*
     * Products
     * */
    public function get_product()
    {
        $product_id = $this->product_id;

        $product = Product::where('id', '=', $product_id)->first();

        return $product->name;
    }

    public function get_subproduct()
    {
        $product_id = $this->subproduct_id;

        if(empty($product_id)){
            return '';
        }

        $sub_product = Subproduct::where('id', '=', $product_id)->first();

        return $sub_product->name;
    }

    /*
     * Spendings
     * */
    public function lw_spending()
    {
        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));
        $result = 0;
        $spendings = Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$last_day, $first_day])
            ->where('campaign_id', $this->id)
            ->get();

        foreach($spendings as $spending){
            $result += $spending->value;
        }

        return $result;
    }

    public function lw_spending_previous()
    {
        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));
        $result = 0;

        $spendings = Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$last_day, $first_day])
            ->where('campaign_id', $this->id)
            ->get();

        foreach($spendings as $spending){
            $result += $spending->value;
        }

        return $result;
    }

    public function spendings_difference()
    {
        $yesterday = $this->lw_spending();
        $day_before = $this->lw_spending_previous();
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

    public function spendings_icon()
    {
        $value = $this->spendings_difference();
        $value = str_replace('%', '', $value);
        if($value < 0){
            $return = 'icon-grow-down';
        } else if($value == 0){
            $return = 'change-none';
        } else {
            $return = 'icon-grow-up';
        }

        return $return;
    }

    public function spendings_icon_big()
    {
        $value = $this->spendings_difference();
        $value = str_replace('%', '', $value);
        if($value < 0){
            $return = 'change-down';
        } else if($value == 0){
            $return = 'change-none';
        } else {
            $return = 'change-up';
        }

        return $return;
    }

    /*
     * Clicks
     * */
    public function lw_clicks()
    {
        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));
        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day, $first_day])
            ->where('campaign_id', $this->id)
            ->count();

        return $clicks;
    }

    public function lw_clicks_previous()
    {
        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));
        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day, $first_day])
            ->where('campaign_id', $this->id)
            ->count();

        return $clicks;
    }

    public function clicks_difference()
    {
        $yesterday = $this->lw_clicks();
        $day_before = $this->lw_clicks_previous();
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

    public function clicks_icon()
    {
        $value = $this->clicks_difference();
        $value = str_replace('%', '', $value);
        if($value < 0){
            $return = 'icon-grow-down';
        } else if($value == 0){
            $return = 'change-none';
        } else {
            $return = 'icon-grow-up';
        }

        return $return;
    }

    public function clicks_icon_big()
    {
        $value = $this->clicks_difference();
        $value = str_replace('%', '', $value);
        if($value < 0){
            $return = 'change-up';
        } else if($value == 0){
            $return = 'change-none';
        } else {
            $return = 'change-up';
        }

        return $return;
    }
}
