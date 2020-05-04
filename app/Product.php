<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function sub_product()
    {
        return $this->hasMany(Subproduct::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function getCampaignsCount(){
        return $this->campaigns()->count();
    }

    public function subproducts_count(){
        return $this->sub_product()->count();
    }

    public function getSpendingsWeekSummary(){
        $summ = 0;
        $spendings = $this->spendings();
        foreach($spendings as $spending)
        {
            $summ += $spending->value;
        }
        return $spendings;
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
            ->where('product_id', $this->id)
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
            ->where('product_id', $this->id)
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


}
