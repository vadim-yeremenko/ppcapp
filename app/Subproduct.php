<?php

namespace App;

use App\Library\CampaignsGet;
use Illuminate\Database\Eloquent\Model;

class Subproduct extends Model
{
    protected $table = 'subproducts';
    /**
     * Define relationship for App\Product
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subproducts()
    {
        return $this->hasOne(Product::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function campaigns_count()
    {
        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('subproduct_id', '=', $this->id)
            ->count();
        if($campaigns > 0){
            $return = $campaigns;
        } else {
            $return = 0;
        }

        return $return;
    }

    public function spendings_last_week()
    {
        $first_day = date("Y-m-d h:i:s", strtotime("-1 week"));
        $last_day = date("Y-m-d h:i:s");

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('subproduct_id', '=', $this->id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        return $return;
    }

    public function spendings_previous_week()
    {
        $first_day = date("Y-m-d h:i:s", strtotime("-2 week"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 week"));

        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('subproduct_id', '=', $this->id)
            ->whereBetween('date', [$first_day, $last_day])
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        return $return;
    }

    public function spendings_difference()
    {
        $yesterday = $this->spendings_last_week();
        $day_before = $this->spendings_previous_week();

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

    /*
     * All spendings
     * */

    public function spendings_total()
    {
        $spendings = \App\Spending::orderBy('id', 'asc')
            ->where('subproduct_id', '=', $this->id)
            ->get();
        if(count($spendings) > 0){
            $count = 0;
            foreach($spendings as $spending){
                $count += $spending->value;
            }
            $return = $count;
        } else {
            $return = 0;
        }
        if($return == 0){
            $return = '0';
        }
        return $return;
    }
}
