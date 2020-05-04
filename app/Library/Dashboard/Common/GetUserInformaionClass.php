<?php

/*
 * Class for clicks for current login user,
 * used on Dashboard
 * */

namespace App\Library\Dashboard\Common;

use App\User;

class GetUserInformaionClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

}
