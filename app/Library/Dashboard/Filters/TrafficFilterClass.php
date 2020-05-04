<?php

/*
 * Class for filtering campaigns
 * */

namespace App\Library\Dashboard\Filters;
use App\Campaign;
use App\Library\Dashboard\Campaign\CampaignTrafficSourceClass;

class TrafficFilterClass
{
    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    public function prepare_data($data)
    {
        $array = explode(';', $data);
        return $array;
    }

    public function run_filter($request)
    {
        $min_click = $this->prepare_data($request->click)['0'];
        $max_click = $this->prepare_data($request->click)['1'];
        $id = $request->id;
        $campaign = Campaign::find($id);
        $user_id = auth()->user();
        $user_id = $user_id->id;
        if($campaign->user_id != $user_id){
            return abort(404);
        }
        $CampaignTrafficSourceClass = new CampaignTrafficSourceClass($id);
        $traffic_array = $CampaignTrafficSourceClass->traffic_list();
        $result = array();
        if(isset($request->click)){
            foreach($traffic_array as $id=>$item)
            {
                if($item['count'] >= $min_click && $item['count'] <= $max_click){
                    $result[$id] = $item;
                }
            }
        }
        /* Success result */
        $returnHTML = view('dashboard.campaign.partials.traffic_source_ajax')->with('traffic_source', array_slice($result, 0, 5, true))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }


    public function run_filter_page($request)
    {
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
        $CampaignTrafficSourceClass = new CampaignTrafficSourceClass($id);
        if(isset($request->pagination)){
            $pagination = (int)$request->pagination;
            if($pagination > 1){
                $length = $length * $pagination;
            }
            $pagination_num = $pagination+1;
        }
        $traffic_array = $CampaignTrafficSourceClass->traffic_list();
        $result = array();
        if(isset($request->click) && !isset($request->spending)){
            foreach($traffic_array as $id=>$item)
            {
                if($item['count'] >= $min_click && $item['count'] <= $max_click){
                    $result[$id] = $item;
                }

            }
        }

        if(isset($request->spending) && !isset($request->click)){
            foreach($traffic_array as $id=>$item)
            {
                if($item['spendings'] >= $min_spending && $item['spendings'] <= $max_spending){
                    $result[$id] = $item;
                }
            }
        }

        if(isset($request->spending) && isset($request->click)){
            foreach($traffic_array as $id=>$item)
            {
                if($item['spendings'] >= $min_spending && $item['spendings'] <= $max_spending && $item['count'] >= $min_click && $item['count'] <= $max_click){
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
        $returnHTML = view('dashboard.traffic_source.partials.traffic_source')->with('traffic_source', array_slice($result, 0, $length, true))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML, 'pagination'=>$pagination_num, 'pagination_end' => $pagination_end));
    }

    private function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }

}