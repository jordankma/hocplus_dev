<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVneClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vne_classes', function (Blueprint $table) {
            $table->increments('classes_id');
            $table->string('create_by')->comment('cua nguoi dang tin');
            $table->string('name');
            $table->string('alias');
            $table->integer('priority', false, true)->nullable();
            $table->string('background_mobile');
            $table->string('color_mobile');

            $table->string('status')->comment('trang thai')->default('enable');

            
            $table->string('folder_name')->nullable();
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
        Schema::dropIfExists('vne_classes');
    }
}
