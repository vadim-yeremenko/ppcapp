<?php

/*
 * Class for campaigns for current login user,
 * used on Dashboard
 * */

namespace App\Library\Dashboard\Common;

class GetCampaignsClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }
}