<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Actividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table){
          $table->bigIncrements('idActividad');
          $table->bigInteger('idCurso')->unsigned();
          $table->string('descripcion', 250);
          $table->boolean('condicion')->default(1);
          $table->timestamps();
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
        Schema::dropIfExists('actividades');
    }
}
