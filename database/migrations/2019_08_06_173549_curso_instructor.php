<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CursoInstructor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursosinstructores', function (Blueprint $table){
          $table->bigIncrements('idCursoInstructor');
          $table->bigInteger('idPersona')->unsigned();
          $table->bigInteger('idCursoAcademia')->unsigned();
          $table->bigInteger('estado')->default(1);
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
          $table->foreign('idCursoAcademia')->references('idCursoAcademia')->on('cursosAcademias');
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
        Schema::dropIfExists('cursosinstructores');
    }
}
