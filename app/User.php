<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function charges()
    {
        return $this->hasMany(Charge::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    /*
     * Spendings
     * */
    public function lw_spending()
    {
        $first_day = date("Y-m-d h:i:s", strtotime("tomorrow"));
        $last_day = date("Y-m-d h:i:s" , strtotime("-1 weeks"));
        $result = 0;
        $spendings = Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$last_day, $first_day])
            ->where('user_id', $this->id)
            ->get();

        foreach($spendings as $spending){
            $result += $spending->value;
        }

        return $result;
    }

    public function lw_spending_previous()
    {
        $first_day = date("Y-m-d", strtotime("-1 weeks"));
        $last_day = date("Y-m-d" , strtotime("-2 weeks"));
        $result = 0;

        $spendings = Spending::orderBy('id', 'asc')
            ->whereBetween('date', [$last_day, $first_day])
            ->where('user_id', $this->id)
            ->get();

        foreach($spendings as $spending){
            $result += $spending->value;
        }

        return $result;
    }

    public function spendings_difference()
    {
        $yesterday = $this->lw_spending();
        $day_before = $this->lw_spending_previous();
        if(!empty($yesterday) && !empty($day_before)){
            $difference = $yesterday - $day_before;

            $val = $difference/$yesterday;
            $return = $val * 100;

            return round($return, 2) . '%';
        } else {
            return '';
        }
    }

    public function spendings_icon()
    {
        $value = $this->spendings_difference();
        $value = str_replace('%', '', $value);
        if($value < 0){
            $return = 'icon-grow-down';
        } else if($value == 0){
            $return = 'change-none';
        } else {
            $return = 'icon-grow-up';
        }

        return $return;
    }

}
