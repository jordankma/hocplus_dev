<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVneTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vne_teachers', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->string('name');
            $table->string('gender')->nullable()->comment('male nam, female nữ');
            $table->string('user_name')->nullable();
            $table->string('password');
            $table->string('alias');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('intro')->nullable();
            $table->string('year_graduation')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('facebook')->nullable();
            $table->string('experience')->nullable();
            $table->string('workplace')->nullable();
            $table->string('avatar_index')->nullable();
            $table->string('avatar_detail')->nullable();
            $table->string('video_intro')->nullable();
            $table->text('achievements')->nullable();
            $table->string('rating')->nullable();
            $table->string('try_create_course')->nullable();
            $table->string('image_cmt_before')->nullable();
            $table->string('image_cmt_after')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_name_account')->nullable();
            $table->text('degree')->nullable();
            $table->text('said_like')->nullable();

            $table->tinyInteger('status', false, true)->default(1);
            $table->tinyInteger('lock', false, true)->default(0);
            $table->dateTime('lock_time')->nullable();
            $table->tinyInteger('activated', false, true)->default(0);
            $table->rememberToken();
            
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
        Schema::dropIfExists('vne_teachers');
    }
}
