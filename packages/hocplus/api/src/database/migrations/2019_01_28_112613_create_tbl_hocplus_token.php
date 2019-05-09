<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblHocplusToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocplus_token', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('member_id', false, true);
            $table->integer('course_id', false, true);
            $table->integer('lesson_id', false, true);
            $table->string('token');
            $table->integer('expired_at')->default(0);
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
        Schema::dropIfExists('hocplus_token');
    }
}
