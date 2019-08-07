<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Academias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academias', function (Blueprint $table){
          $table->bigIncrements('idAcademia');
          $table->bigInteger('idContacto')->unsigned();
          $table->string('nombre', 50);
          $table->string('telefono', 50);
          $table->string('direccion', 50);
          $table->string('estado', 50);
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
          $table->foreign('idContacto')->references('idContacto')->on('contactos');
        });
    }
  
  

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academias');
    }
}
