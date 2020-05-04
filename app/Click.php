<?php

namespace App;

use App\Product;
use App\Spending;
use App\Subproduct;
use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    public function spending()
    {
        return $this->hasOne(Spending::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function subproduct()
    {
        return $this->hasOne(Subproduct::class);
    }

}
