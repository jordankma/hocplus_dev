<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherClassHassSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_class_subject', function (Blueprint $table) {
            $table->increments('teacher_class_subject_id');
            $table->integer('classes_id', false, true);
            $table->integer('subject_id', false, true);
            $table->integer('teacher_id', false, true);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('classes_id')->references('classes_id')->on('classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subject')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('tbl_teacher')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_class_subject');
    }
}
