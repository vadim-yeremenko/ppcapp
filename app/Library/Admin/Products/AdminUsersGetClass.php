<?php

namespace App\Library\Admin\Products;

use App\User;

class AdminUsersGetClass
{
    public function get_users_list($limit = 6)
    {
        $users = User::orderBy('id', 'desc')
            ->limit($limit)
            ->role('customer')
            ->where('active', '=', '1')
            ->get();
        return $users;
    }

}