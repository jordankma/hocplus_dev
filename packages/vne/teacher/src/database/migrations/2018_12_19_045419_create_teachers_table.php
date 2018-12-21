<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->string('name');
            $table->string('alias');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('intro')->nullable();
            $table->string('year_graduation')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('experience')->nullable();
            $table->string('workplace')->nullable();
            $table->string('avatar')->nullable();
            $table->string('video_intro')->nullable();
            $table->string('achievements')->nullable();
            $table->string('rating')->nullable();
            $table->string('degree')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
