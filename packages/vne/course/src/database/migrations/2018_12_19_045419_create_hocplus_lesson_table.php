<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocplusLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocplus_lesson', function (Blueprint $table) {
            $table->increments('lesson_id');
            $table->string('name');
            $table->integer('date_start');
            $table->integer('ordinal')->default(0)->comment('Thứ tự hiển thị');
            $table->string('content');            
            $table->tinyInteger('active')->default(1);
            $table->integer('course_id');                                    
            $table->softDeletes();
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
        Schema::dropIfExists('hocplus_lesson');
    }
}
