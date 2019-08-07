<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CursoAcademia extends Migration
{

    public function up()
    {
          Schema::create('cursosAcademias', function (Blueprint $table){
          $table->bigIncrements('idCursoAcademia');
          $table->bigInteger('idAcademia')->unsigned();
          $table->bigInteger('idCurso')->unsigned();
          $table->boolean('estado')->default(1);
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
          $table->foreign('idAcademia')->references('idAcademia')->on('academias');
          $table->foreign('idCurso')->references('idCurso')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursosAcademias');
    }
}
