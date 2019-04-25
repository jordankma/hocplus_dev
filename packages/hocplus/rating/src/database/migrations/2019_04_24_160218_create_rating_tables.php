<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocplus_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("course_id");
            $table->integer("member_id");   
            $table->integer("rate");            
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
        Schema::dropIfExists('hocplus_rating');
    }
}
