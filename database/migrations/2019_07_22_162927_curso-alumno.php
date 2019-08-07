<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CursoAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursoAlumno', function (Blueprint $table){
          $table->bigInteger('idCurso')->unsigned();
          $table->bigInteger('idAlumno')->unsigned();
          $table->string('estado', 50);
          $table->bigInteger('califGeneral');
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
             $table->foreign('idCurso')->references('idCurso')->on('cursos');
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
        Schema::dropIfExists('cursoAlumno');
    }
}
