<?php

namespace App\Library;

use App\Campaign;
use App\Click;
use App\Spending;
use App\Product;
use App\Subproduct;

class CampaignsGet
{
    /*
     * Get campaigns by product ID
     *
     * */
    public function get_campaigns($product_id)
    {
        if(!$product_id){
            return '0';
        }

        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('product_id', '=', $product_id)
            ->get();
        if(count($campaigns) > 0){
            $return = count($campaigns);
        } else {
            $return = 0;
        }


        return $return;
    }

    public function get_campaigns_count_for_current_user()
    {
        $user = auth()->user();
        $user = $user->id;
        $date = date("m-d-Y H:i:s");
        if(!$user){
            return false;
        }
        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('user_id', '=', $user)
            ->where('is_active', '=', '1')
            ->where('date', '>=', $date)
            ->get();
        $count = count($campaigns);
        if($count == 0){
            $return = '0 campaigns';
        } else if($count == 1){
            $return = '1 campaign';
        } else {
            $return = $count.' campaigns';
        }
        return $return;
    }

    public function get_campaigns_list_for_current_user()
    {
        $user = auth()->user();
        $user = $user->id;
        if(!$user){
            return false;
        }
        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('user_id', '=', $user)
            ->where('is_active', '=', '1')
            ->limit('6')
            ->get();

        return $campaigns;
    }

    public function get_campaigns_list_by_user_id($id, $pagination, $pagination_limit, $pagination_offset)
    {
        if(!$id){
            return false;
        }
        if(empty($pagination) || !$pagination){
            $campaigns = \App\Campaign::orderBy('id', 'asc')
                ->where('user_id', '=', $id)
                ->where('is_active', '=', '1')
                ->limit(5)
                ->get();
        } else {
            $campaigns = \App\Campaign::orderBy('id', 'asc')
                ->where('user_id', '=', $id)
                ->where('is_active', '=', '1')
                ->offset($pagination_offset)
                ->limit($pagination_limit)
                ->get();
        }

        return $campaigns;
    }

    /*
     *
     * Used for filter min and max values
     *
     * */
    public function get_campaigns_count_all_products()
    {
        $result = array();
        $array_products = array();

        $products = Product::orderBy('id', 'asc')->get();

        foreach($products as $product){
            $array_products[] = $product->getCampaignsCount();
        }

        if(count($array_products) > 0){
            $result['min'] = min($array_products);
            $result['max'] = max($array_products);
        } else {
            $result['min'] = '0';
            $result['max'] = '0';
        }

        return $result;
    }

    /*
     * Get count for all running campaigns for admin panel report
     * */

    public function get_all_running_count()
    {
        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('is_active', '=', '1')
            ->get();
        $count = count($campaigns);

        if($count == 1){
            return $count .' campaign';
        } else {
            return $count .' campaigns';
        }
    }

    public function get_running_campaigns()
    {
        $campaigns = \App\Campaign::orderBy('title', 'asc')
            ->where('is_active', '=', '1')
            ->get();
        return $campaigns;
    }

    public function get_campaigns_list_user($id)
    {
        $campaigns = \App\Campaign::orderBy('title', 'asc')
            ->where('is_active', '=', '1')
            ->where('user_id', '=', $id)
            ->get();
        return $campaigns;
    }


    /*
     * ============================ Campaign statistics by ID ========================
     *
     * */
    public function get_campaign_last_week_spending_id($id)
    {
        if(empty($id))
            return '';

        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));

        $clicks = Spending::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->where('campaign_id', $id)
            ->get();

        return count($clicks);
    }

    public function get_campaign_previous_week_spending_id($id)
    {
        if(empty($id))
            return '';

        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));

        $clicks = Spending::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->where('campaign_id', $id)
            ->get();

        return count($clicks);
    }

    public function get_campaign_last_week_icon_spending_id($id)
    {
        if(empty($id))
            return '';

        $value = $this->get_campaigns_last_week_difference_spending_id($id);
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

    public function get_campaigns_last_week_difference_spending_id($id)
    {
        $yesterday = $this->get_campaign_last_week_spending_id($id);
        $day_before = $this->get_campaign_previous_week_spending_id($id);
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

    /*
     * ============================ Campaign clicks statistics by ID ========================
     *
     * */
    public function get_campaign_last_week_click_id($id)
    {
        if(empty($id))
            return '';

        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->where('campaign_id', $id)
            ->get();

        return count($clicks);
    }

    public function get_campaign_previous_week_click_id($id)
    {
        if(empty($id))
            return '';

        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));

        $clicks = Click::orderBy('id', 'asc')
            ->whereBetween('created_at', [$last_day.'%', $first_day.'%'])
            ->where('campaign_id', $id)
            ->get();

        return count($clicks);
    }

    public function get_campaign_last_week_icon_click_id($id)
    {
        if(empty($id))
            return '';

        $value = $this->get_campaigns_last_week_difference_click_id($id);
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

    public function get_campaigns_last_week_difference_click_id($id)
    {
        $yesterday = $this->get_campaign_last_week_click_id($id);
        $day_before = $this->get_campaign_previous_week_click_id($id);
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }


}