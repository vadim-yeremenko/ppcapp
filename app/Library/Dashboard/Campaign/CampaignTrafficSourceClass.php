<?php

namespace App\Library\Dashboard\Campaign;

use App\Campaign;
use App\Click;
use App\Spending;
use function MongoDB\BSON\toJSON;

class CampaignTrafficSourceClass
{
    protected $campaign_id;
    protected $campaigns;
    protected $clicks;

    public function __construct($id)
    {
        $this->campaign_id = $id;
        $this->campaign = Campaign::find($id);
        $this->clicks = Click::where('campaign_id', '=', $id)->get();
    }

    /**
     * @return mixed
     */
    public function traffic_list()
    {
        $array = array();
        foreach($this->clicks as $click){

            if(!$this->in_array_r($click->url, $array))
            {
                $array[$click->id]['spendings'] = strval($this->get_spendings($click->id));
                $array[$click->id]['url'] = $click->url;
                $array[$click->id]['url_trim'] = $this->word_safe_break($click->url);
                $clicks_count = Click::where('url', '=', $click->url)
                    ->where('campaign_id', '=', $this->campaign_id)
                    ->count();
                $array[$click->id]['count'] = $clicks_count;
            }

        }
        return $array;
    }

    /**
     * @return mixed
     */
    public function traffic_list_limited()
    {
        $array = $this->traffic_list();

        return array_slice($array, 0, 5, true);
    }

    public function traffic_click_min()
    {
        $array = $this->traffic_list();
        $min = 0;
        foreach( $array as $k => $v )
        {
            $min = min( array( $min, $v['count'] ) );
        }
        return $min;

    }

    public function traffic_click_max()
    {
        $array = $this->traffic_list();
        $max = 0;
        foreach( $array as $k => $v )
        {
            $max = max( array( $max, $v['count'] ) );
        }
        return $max;
    }

    public function traffic_spendings_min()
    {
        $array = $this->traffic_list();
        $min = 0;
        foreach( $array as $k => $v )
        {
            $min = min( array( $min, $v['spendings'] ) );
        }
        return $min;

    }

    public function traffic_spendings_max()
    {
        $array = $this->traffic_list();
        $max = 0;
        foreach( $array as $k => $v )
        {
            $max = max( array( $max, $v['spendings'] ) );
        }
        return $max;
    }

    /**
     * @return mixed
     */
    public function traffic_list_filter($request)
    {
        $result = array();
        $param_click = explode(';', $request->click);
        $click_min = $param_click[0];
        $click_max = $param_click[1];

        $array = $this->traffic_list();

        foreach($array as $id => $item)
        {
            if($item['count'] >= $click_min && $item['count'] <= $click_max){
                $result[$id] = $item;
            }
        }

        return response()->json(array('success' => true, 'html'=>$result));
    }

    /**
     * @return mixed
     */
    public function traffic_list_pagination($request)
    {
        return $this->traffic_list_filter($request);
    }

    private function get_spendings($click)
    {
        $spendings = Spending::where('click_id', '=', $click)->get();
        $counter = 0;
        if(count($spendings) > 0){
            foreach($spendings as $spending)
            {
                $counter += $spending->value;
            }
            return $counter;
        } else {
            return '0';
        }

    }

    /* ======================== Helper functions ====================
     *
     * */
    private function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }


    /*
     * Function break word
     * */
    private function word_safe_break($str)
    {
        $result = '';

        $words_count = strlen($str);
        if($words_count > 30){
            $words_count_half = round($words_count/2, 0, PHP_ROUND_HALF_UP);
            $first_part = substr($str, 0, $words_count_half);
            $second_part = substr($str, $words_count_half-1, $words_count_half);

            $result = mb_strimwidth($first_part, 0, 20, '...').mb_strimwidth($second_part, $words_count_half-8, 8, '');
        } else {
            $result = $str;
        }

        return $result;

    }
}