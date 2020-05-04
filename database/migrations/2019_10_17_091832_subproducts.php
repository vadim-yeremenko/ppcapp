<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->nullable();
            $table->integer('active')->default('1');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('url')->nullable();
            $table->float('mincpc')->default(0);
            $table->float('maxcpc')->default(0);
            $table->float('fixcpc')->default(0);
            $table->string('image')->nullable();
            $table->integer('clicks_total')->default(0);
            $table->integer('clicks_last_week')->default(0);
            $table->integer('campaigns_count')->default(0);
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
        Schema::dropIfExists('subproducts');
    }
}
