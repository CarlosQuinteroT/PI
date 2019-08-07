<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table){
          $table->bigIncrements('idAlumno');
          $table->bigInteger('idPersona')->unsigned();
          $table->bigInteger('idAcademia')->unsigned();
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
          $table->foreign('idPersona')->references('idPersona')->on('personas');
          $table->foreign('idAcademia')->references('idAcademia')->on('academias');
        });
      
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
