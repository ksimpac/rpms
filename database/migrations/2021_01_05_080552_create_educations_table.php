<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreign('username')->references('username')->on('users');
            $table->string('schoolName', 100); //學校名
            $table->string('department', 100); //院系科名
            $table->date('startDate'); //修業年月起
            $table->date('endDate'); //修業年月迄
            $table->enum('degree', ['大學', '碩士', '博士']); //學位
            $table->enum('status', ['畢業', '結業', '肄業']); //修業狀況
            $table->string('country', 100); //畢業國家
            $table->string('thesis', 100)->nullable(); //畢業論文
            $table->string('advisor', 100)->nullable(); //指導教授
            $table->char('certificate', 14); //畢業證書或完成口試證明
            $table->char('transcript', 14)->nullable(); //成績單上傳
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
        Schema::dropIfExists('education');
    }
}
