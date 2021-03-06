<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('chineseName'); //姓名
            $table->string('email')->unique()->nullable();
            $table->string('National_ID_No')->nullable(); //身分證字號
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedTinyInteger('is_admin');
            $table->unsignedTinyInteger('isSignup')->default(0);
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
