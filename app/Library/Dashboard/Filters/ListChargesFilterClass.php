<?php

/*
 * Class for filtering
 * Charges list on Balance page
 * */

namespace App\Library\Dashboard\Filters;


use App\Library\Dashboard\Common\GetChargesClass;

class ListChargesFilterClass
{
    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    private function get_list()
    {
        $charges = new GetChargesClass();
        return $charges->charges();
    }

    public function run_filter($request)
    {

    }
}