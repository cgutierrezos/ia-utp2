<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EdgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grafo_id')->unsigned();
            $table->integer('nodei_id')->unsigned();
            $table->integer('nodef_id')->unsigned();
            $table->integer('value')->unsigned();
            $table->unique(array('grafo_id','nodei_id','nodef_id'));
            $table->timestamps();

            $table->foreign('grafo_id')->references('id')->on('grafos')->onDelete('cascade');
            $table->foreign('nodei_id')->references('id')->on('nodes')->onDelete('cascade');
            $table->foreign('nodef_id')->references('id')->on('nodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('edges');
    }
}
