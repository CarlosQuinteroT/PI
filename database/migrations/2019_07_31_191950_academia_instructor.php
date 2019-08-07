<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcademiaInstructor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academiasInstructores', function (Blueprint $table){
          $table->bigIncrements('idAcademiaInstructor');
          $table->bigInteger('idAcademia')->unsigned();
          $table->bigInteger('idPersona')->unsigned()->unique();
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
          
          $table->foreign('idAcademia')->references('idAcademia')->on('academias');
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
          Schema::dropIfExists('academiasInstructores');
    }
}
