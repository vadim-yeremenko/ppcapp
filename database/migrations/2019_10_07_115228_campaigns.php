<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->float('cpc')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('subproduct_id')->nullable();
            $table->string('image')->nullable();
            $table->integer('is_active')->default( 0);
            $table->dateTime('date')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->integer('clicks_total')->default(0);
            $table->integer('clicks_last_week')->default(0);
            $table->float('spendings_total')->default(0);
            $table->float('spendings_last_week')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
