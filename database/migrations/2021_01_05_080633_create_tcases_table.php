<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcase', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreign('username')->references('username')->on('users');
            $table->string('projectName', 100); //計畫名稱
            $table->string('collaboration_name', 100); //合作機構名稱
            $table->date('startDate'); //執行起始日期
            $table->date('endDate'); //執行結束日期
            $table->enum('jobkind', ['主持人', '共同主持人']); //工作類別
            $table->unsignedInteger('plantotal_money'); //計畫總金額
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
        Schema::dropIfExists('tcase');
    }
}
