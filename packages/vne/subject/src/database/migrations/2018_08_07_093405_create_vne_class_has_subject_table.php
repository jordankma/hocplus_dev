<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVneClassHasSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vne_class_has_subject', function (Blueprint $table) {
            $table->increments('class_has_subject_id');
            $table->integer('classes_id', false, true);
            $table->integer('subject_id', false, true);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('classes_id')->references('classes_id')->on('vne_classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('vne_subject')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vne_class_has_subject');
    }
}
