<?php

/*
 * Getting list with all balance charges for user
 * */

namespace App\Library\Dashboard\Balance;

use App\Charge;
use App\Library\Dashboard\Common\GetChargesClass;

class BalanceListChargesClass
{
    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    public function run()
    {
        $charges = Charge::orderBy('date', 'desc')->where('user_id', '=', $this->user)
            ->limit(10)
            ->get();
        return $charges;
    }
}