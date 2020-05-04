<?php


namespace App\Library\Dashboard\Campaign;

class CampaignsListClass
{
    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    public function active_campaigns($limit = 7)
    {
        $campaigns = \App\Campaign::orderBy('id', 'asc')
            ->where('user_id', '=', $this->user)
            ->where('is_active', '=', '1')
            ->limit($limit)
            ->get();
        return $campaigns;
    }

}