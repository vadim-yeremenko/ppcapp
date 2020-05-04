<?php

namespace App\Library;

use App\User;

class NotificationsGet
{
    protected $user;

    public function __construct()
    {
        /* Get user object */
        $this->get_user();
    }

    public function get_user()
    {
        $user_id = auth()->user();
        $user_id = $user_id->id;
        if(!$user_id){
            return false;
        }
        $user = \App\User::find($user_id);
        $this->user = $user;
    }

    public function notifications_list()
    {

    }
}