<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_info', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreign('username')->references('username')->on('users')
                ->constrained()->onDelete('cascade');
            $table->string('englishName', 100); //英文姓名
            $table->date('birthday'); //生日
            $table->unsignedTinyInteger('sex'); //性別，0為女，1為男
            $table->char('telephone', 10); //聯絡電話
            $table->string('Permanent_Address', 100); //戶籍地址
            $table->string('Residential_Address', 100); //通訊地址
            $table->enum('teacherCertificateType', ['教授', '副教授', '助理教授', '講師', '無']); //教師證職級
            $table->char('teacherCertificateFiles', 14)->nullable(); //教師證影本
            $table->string('position', 100); //現職
            $table->enum('specialization', ['智慧流通', '物流運輸', '新零售', '其他']); //專長領域
            $table->text('course'); //曾授課程或可授課程
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
        Schema::dropIfExists('general_info');
    }
}
