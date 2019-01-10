<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocplusCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocplus_course', function (Blueprint $table) {
            $table->increments('course_id');            
            $table->integer('student_limit');
            $table->integer('student_register')->nullable();
            $table->integer('date_start');
            $table->integer('date_end');
            $table->string('time')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('active')->default(1);
            $table->integer('price')->nullable();            
            $table->integer('discount');
            $table->integer('discount_exp');
            $table->integer('number_lesson')->default(0);
            $table->string('name');
            $table->string('avatar');
            $table->string('video')->nullable();
            $table->string('will_learn')->nullable();
            $table->string('target')->nullable();
            $table->string('request_content')->nullable();
            $table->string('summary')->nullable();
            $table->tinyInteger('is_hot')->nullable()->default(1);
            $table->integer('classes_id');
            $table->integer('subject_id');
            $table->integer('teacher_id');                       
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
        Schema::dropIfExists('hocplus_course');
    }
}
