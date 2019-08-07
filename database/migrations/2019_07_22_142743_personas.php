<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Personas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table){
          $table->bigIncrements('idPersona');
          $table->string('nombre', 50);
          $table->string('apellidoPaterno', 50);
          $table->string('apellidoMaterno', 50);
          $table->string('direccion', 250);
          $table->string('telefono', 50);
          $table->string('email', 50);
          $table->string('imagen')->nullable();
          $table->boolean('condicion')->default(1);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
