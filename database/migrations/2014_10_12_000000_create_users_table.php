<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('active')->default(0);
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('organization')->nullable();
            $table->string('role')->nullable();
            $table->string('avatar')->nullable();
            $table->float('balance')->default(0);
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('campaigns_count')->default(0);
            $table->float('spendings_total')->default(0);
            $table->float('spendings_last_week')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
