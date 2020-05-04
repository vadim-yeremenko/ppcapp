<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date')->nullable();
            $table->string('user_agent')->default('');
            $table->string('country')->default('');
            $table->string('ip')->default('');
            $table->string('url')->default('');
            $table->integer('user_id')->default(0);
            $table->integer('campaign_id')->default(0);
            $table->integer('spending_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->integer('subproduct_id')->default(0);
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
        Schema::dropIfExists('clicks');
    }
}
