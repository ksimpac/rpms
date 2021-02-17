<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisConfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_conf', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreign('username')->references('username')->on('users')
                ->constrained()->onDelete('cascade');
            $table->string('conf_name'); //研討會名稱
            $table->string('thesisName'); //論文名稱
            $table->year('years'); //發表年份
            $table->unsignedTinyInteger('authorNo'); //作者總人數
            $table->unsignedTinyInteger('corresponding_author'); //是否為通訊作者，0為否，1為是
            $table->string('country'); //舉行之國家或城市
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
        Schema::dropIfExists('thesis_conf');
    }
}
