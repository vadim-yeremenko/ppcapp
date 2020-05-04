<?php

/*
 * Class for charges for current login user,
 * used on Dashboard
 * */

namespace App\Library\Dashboard\Common;

use App\Charge;

class GetChargesClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    /*
     * Get objects for all charges
     * for user
     * */
    public function charges($limit = 10)
    {
        $charges = Charge::orderBy('date', 'desc')->where('user_id', '=', $this->user)
            ->limit($limit)
            ->get();
        return $charges;
    }

}