<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table){
          $table->bigIncrements('idCurso');
          $table->string('nombreCurso', 100);
          $table->string('costo', 50);
          $table->date('fechaInicio');
          $table->date('fechaFin');
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
          
//           $table->foreign('idInstructor')->references('idInstructor')->on('instructores');
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
