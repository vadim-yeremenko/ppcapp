<?php

/*
 * Class for data on the "Spent box"
 * */

namespace App\Library\Dashboard\Balance;

class BalanceSpentClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    /*
     * Get all clicks count
     * */
    public function clicks()
    {
        $user = auth()->user();
        return $user->balance;
    }
}