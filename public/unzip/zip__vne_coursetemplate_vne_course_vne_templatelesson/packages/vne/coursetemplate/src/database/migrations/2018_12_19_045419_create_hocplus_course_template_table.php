<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocplusCourseTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocplus_course_templates', function (Blueprint $table) {
            $table->increments('course_template_id');
            $table->string('template_name');
            $table->string('template_avatar');
            $table->string('template_video_intro')->nullable();
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
        Schema::dropIfExists('hocplus_course_templates');
    }
}
