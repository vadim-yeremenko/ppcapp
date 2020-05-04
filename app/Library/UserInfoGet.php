<?php

namespace App\Library;

class UserInfoGet
{
    public function __construct()
    {

    }


    public function get_user_info()
    {
        $user_id = auth()->user();
        $user_id = $user_id->id;
        if(!$user_id){
            return false;
        }
        $user = \App\User::orderBy('id', 'asc')
            ->where('id', '=', $user_id)
            ->first();
        return $user;
    }
}