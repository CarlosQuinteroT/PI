<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table){
          $table->bigIncrements('idContacto');
          $table->bigInteger('idPersona')->unsigned();
          $table->string('estado', 50);
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
          $table->foreign('idPersona')->references('idPersona')->on('personas');
        });
      
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos');
    }
}
