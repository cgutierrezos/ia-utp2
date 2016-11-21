<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ObjetosatributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos_atributos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sistema_id')->unsigned();
            $table->integer('objeto_id')->unsigned();
            $table->integer('atributo_id')->unsigned();
            $table->timestamps();

            $table->foreign('sistema_id')->references('id')->on('sistemasexpertos')->onDelete('cascade');
            $table->foreign('objeto_id')->references('id')->on('objetos')->onDelete('cascade');
            $table->foreign('atributo_id')->references('id')->on('atributos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('objetos_atributos');
    }
}
