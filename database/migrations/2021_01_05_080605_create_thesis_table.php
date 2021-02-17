<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreign('username')->references('username')->on('users')
                ->constrained()->onDelete('cascade');
            $table->string('publicationName'); //刊物名稱
            $table->char('publicationDate', 7); //年月
            $table->string('DOI');
            $table->unsignedTinyInteger('authorNo'); //作者總人數
            $table->unsignedTinyInteger('order'); //作者順序
            $table->string('rank_factor');
            $table->unsignedTinyInteger('corresponding_author'); //是否為通訊作者，0為否，1為是
            $table->string('thesisName'); //論文名稱
            $table->enum('type', ['SCI', 'SCIE', 'SSCI', '其他']); //收錄分類
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
        Schema::dropIfExists('thesis');
    }
}
