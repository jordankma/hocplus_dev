<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_vne')->create('tbl_teachers', function (Blueprint $table) {
            $table->increments('teachers_id');
            $table->string('teacher_name');
            $table->string('teacher_alias');
            $table->string('teacher_phone');
            $table->string('teacher_email');
            $table->string('teacher_address');
            $table->string('teacher_experience');
            $table->string('teacher_workplace');
            $table->string('teacher_avatar');
            $table->string('teacher_intro');
            $table->string('teacher_rating');
            $table->string('degree');
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
        Schema::connection('mysql_vne')->dropIfExists('tbl_teachers');
    }
}
