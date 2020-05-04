<?php

/*
 * Class for campaigns for all users,
 * used on Dashboard
 * */

namespace App\Library\Admin\Common;

class AdminGetCampaignsClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }
}