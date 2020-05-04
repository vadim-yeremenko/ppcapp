<?php

use App\Charge;
use App\User;
use Illuminate\Database\Seeder;
use App\Product;
use App\Click;
use App\Campaign;
use App\Spending;
use \App\Subproduct;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Spending::truncate();
//        factory(\App\Spending::class, 30)->create();
//        Product::truncate();
//        Subproduct::truncate();
        //factory(Product::class, 10)->create();
//        factory(Product::class, 10)->create()->each( function ($product) {
//            $product->sub_product()->saveMany(factory(Subproduct::class, 4)->make());
//        });
            //factory(Charge::class, 30)->create();
//        Click::truncate();
//        Spending::truncate();
//        factory(Spending::class, 1000)->create();
//        factory(Click::class, 1000)->create();
        //Charge::truncate();
        //factory(Charge::class, 200)->create();
//
//        Campaign::truncate();
//        factory(Campaign::class, 100)->create();

//        Product::truncate();
//        Subproduct::truncate();
//        factory(Product::class, 30)->create();
//        factory(Subproduct::class, 30)->create();
//
        factory(User::class, 30)->create();
//        factory(Click::class, 200)->create();
        // factory(Charge::class, 200)->create();
//        factory(Spending::class, 200)->create();
    }
}
