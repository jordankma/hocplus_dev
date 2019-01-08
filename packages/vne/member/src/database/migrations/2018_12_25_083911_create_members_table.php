<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id');
            $table->string('name')->nullable();
            $table->string('user_name');
            $table->string('password');
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('type')->default('student')->comment('student, parent, teacher');
            $table->string('avatar')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('gender')->nullable()->comment('male nam, female nữ');
            $table->text('address')->nullable()->comment('địa chỉ');
            $table->text('intro')->nullable()->comment('gioi thieu');
            $table->text('facebook')->nullable()->comment('fb');
            $table->text('reg_ip')->nullable()->comment('ip dang ky');
            $table->text('last_ip')->nullable()->comment('ip vao cuoi cung');
            $table->text('last_login')->nullable()->comment('lan dang nhap cuoi');
            
            
            $table->tinyInteger('status', false, true)->default(1);
            $table->tinyInteger('lock', false, true)->default(0);
            $table->dateTime('lock_time')->nullable();
            $table->string('activated_code')->nullable();
            $table->tinyInteger('activated', false, true)->default(0);
            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
