<?php

/*
 * Class for Balance graph
 * */
namespace App\Library\Dashboard\Balance;
use App\Charge;

class BalanceGraphClass
{

    protected $user;

    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user->id;
    }

    /*
     * Charges list
     * */
    public function charges($limit = 10)
    {
        $charges = Charge::orderBy('date', 'desc')
            ->where('user_id', '=', $this->user)
            ->limit($limit)
            ->get();
        return $charges;
    }

    /*
     * Last charge
     * */
    public function last_charge()
    {
        $charge = Charge::orderBy('date', 'desc')
            ->where('user_id', '=', $this->user)
            ->first();
        return $charge;
    }

    /*
     * Run and get all charges (limited or not)
     * */
    public function run()
    {
        $result = '';

        $charges = $this->charges();

        return $charges;
    }

    /*
    * Get last 7 charges for graph
    * */
    public function graph_list()
    {
        $result = array();

        $charges = $this->charges(7);

        foreach ($charges as $charge){
            $result[] = round($charge->value);
        }

        return $result;
    }

}