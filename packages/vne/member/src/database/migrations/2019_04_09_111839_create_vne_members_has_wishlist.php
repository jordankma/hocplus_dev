<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVneMembersHasWishlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vne_members_has_wishlist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id', false, true);
            $table->integer('course_id', false, true);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('member_id')->references('member_id')->on('vne_members');
            $table->foreign('course_id')->references('course_id')->on('hocplus_course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vne_members_has_wishlist');
    }
}
