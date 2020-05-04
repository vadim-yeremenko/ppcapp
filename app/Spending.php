<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }

    public function click()
    {
        return $this->hasOne(Click::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function subproduct()
    {
        return $this->hasOne(Subproduct::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
