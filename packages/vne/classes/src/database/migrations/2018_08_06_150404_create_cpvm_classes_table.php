<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpvmClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_cpvm')->create('tbl_class', function (Blueprint $table) {
            $table->increments('class_id');
            $table->string('class_name');
            $table->string('alias');
            $table->string('class_icon')->nullable();
            $table->integer('priority', false, true)->nullable();

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
        Schema::connection('mysql_cpvm')->dropIfExists('classes');
    }
}
