<?php

namespace App\Library\Dashboard\Filters;

use App\Campaign;
use App\Library\Dashboard\Campaign\CampaignDailyOverviewClass;
use App\Library\Dashboard\Campaign\CampaignTrafficSourceClass;

class DailyOverviewFilterClass
{
    public function __construct()
    {

    }

    public function get_list($campaign)
    {
        $listClass = new CampaignDailyOverviewClass();
        return $listClass->get_full_list($campaign);
    }

    public function run_filter($request)
    {
        $result = array();
        $array = $this->get_list($request->campaign_id);
        $length = 5;
        $length_value = 5;
        $min_click = $this->prepare_data($request->click)['0'];
        $max_click = $this->prepare_data($request->click)['1'];
        $min_spending = $this->prepare_data($request->spending)['0'];
        $max_spending = $this->prepare_data($request->spending)['1'];
        $id = $request->campaign_id;
        $items_count = $length;
        $pagination_num = 2;
        $campaign = Campaign::find($id);
        $user_id = auth()->user();
        $user_id = $user_id->id;
        if($campaign->user_id != $user_id){
            return abort(404);
        }
        if(isset($request->pagination)){
            $pagination = (int)$request->pagination;
            if($pagination > 1){
                $length = $length * $pagination;
            }
            $pagination_num = $pagination+1;
        }
        $result = array();
        if(isset($request->click) && !isset($request->spending)){
            foreach($array as $id=>$item)
            {
                if($item['clicks'] >= $min_click && $item['clicks'] <= $max_click){
                    $result[$id] = $item;
                }
            }
        }

        if(isset($request->spending) && !isset($request->click)){
            foreach($array as $id=>$item)
            {
                if($item['spendings'] >= $min_spending && $item['spendings'] <= $max_spending){
                    $result[$id] = $item;
                }
            }
        }

        if(isset($request->spending) && isset($request->click)){
            foreach($array as $id=>$item)
            {
                if($item['spendings'] >= $min_spending && $item['spendings'] <= $max_spending && $item['clicks'] >= $min_click && $item['clicks'] <= $max_click){
                    $result[$id] = $item;
                }
            }
        }

        $items_count = count($result);

        if($items_count >= $length_value * $pagination_num){
            $pagination_end = false;
        } else {
            $pagination_end = true;
        }

        /* Success result */
        $returnHTML = view('dashboard.campaign.partials.daily_overview_ajax')->with('daily_overview', array_slice($result, 0, $length, true))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML, 'pagination'=>$pagination_num, 'pagination_end' => $pagination_end));
    }

    public function prepare_data($data)
    {
        $array = explode(';', $data);
        return $array;
    }

}