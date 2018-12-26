<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocplusTemplateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocplus_template_lesson', function (Blueprint $table) {
            $table->increments('template_lesson_id');
            $table->string('name');
            $table->string('content');            
            $table->tinyInteger('active')->default(1);
            $table->integer('course_template_id');                                    
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
        Schema::dropIfExists('hocplus_template_lesson');
    }
}
