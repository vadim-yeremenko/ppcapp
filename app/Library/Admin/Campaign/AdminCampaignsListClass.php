<?php


namespace App\Library\Admin\Campaign;

class AdminCampaignsListClass
{

    public function __construct()
    {
    }

    public function active_campaigns($limit = 7)
    {
        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('is_active', '=', '1')
            ->limit($limit)
            ->get();
        return $campaigns;
    }

    public function campaigns_by_user($id, $limit)
    {
        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('is_active', '=', '1')
            ->where('user_id', '=', $id)
            ->limit($limit)
            ->get();
        return $campaigns;
    }

}