<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocplus_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("news_id")->nullable();
            $table->integer("course_id")->nullable();
            $table->integer("user_id");
            $table->string('comment');
            $table->tinyInteger("status")->default('0');
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
        Schema::dropIfExists('comments');
    }
}
