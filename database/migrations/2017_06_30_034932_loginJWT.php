<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoginJWT extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('loginJWT')) {
          Schema::create('loginJWT', function (Blueprint $table) {
              $table->string('email')->unique();
              $table->mediumText('access_token');
              $table->mediumText('refresh_token');
              $table->string('status');
              $table->timestamps();
          });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('password_resets');
    }
}
