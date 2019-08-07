<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividadAlumno', function (Blueprint $table){
          $table->bigInteger('idAlumno')->unsigned();
          $table->bigInteger('idActividad')->unsigned();
          $table->bigInteger('CalifActividad', 50);
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          $table->foreign('idActividad')->references('idActividad')->on('actividades');
          $table->foreign('idAlumno')->references('idAlumno')->on('alumnos');
        });
      
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividadAlumno');
    }
}
