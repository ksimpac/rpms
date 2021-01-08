<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustryExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_experience', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreign('username')->references('username')->on('users')
                ->constrained()->onDelete('cascade');
            $table->string('working_units', 100); //任職單位
            $table->string('position', 100); //職稱
            $table->enum('type', ['兼任', '專任']); //專兼任
            $table->text('job_description'); //工作內容
            $table->char('startDate', 7); //任職時間起
            $table->char('endDate', 7); //任職時間迄
            $table->char('identification', 14); //佐證資料上傳
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
        Schema::dropIfExists('industry_experience');
    }
}
