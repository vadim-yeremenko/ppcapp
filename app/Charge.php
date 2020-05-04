<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /*
     * Date looks in format 06/31/19
     * */
    public function modified_date()
    {
        $date = $this->date;
        if($date){
            return date("m/d/Y", strtotime($date));
        } else {
            return '';
        }

    }

}
