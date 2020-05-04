<?php


namespace App\Library\Dashboard\Campaign;

use App\Campaign;

class CampaignStatisticsClass
{
    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;

    }

    public function get_statistics($id)
    {
        if(empty($id))
            return '';

        $return = array();

        $campaign = Campaign::find($id);

        $return['lw_spendings'] = $campaign->lw_spending();
        $return['lw_spendings_icon'] = $campaign->spendings_icon_big();
        $return['lw_spendings_difference'] = $campaign->spendings_difference();

        $return['lw_clicks'] = $campaign->lw_clicks();
        $return['lw_clicks_icon'] = $campaign->clicks_icon_big();
        $return['lw_clicks_difference'] = $campaign->clicks_difference();

        $return['spendings'] = $campaign->spendings_total;
        $return['clicks'] =  $campaign->clicks_total;

        return $return;

    }

}