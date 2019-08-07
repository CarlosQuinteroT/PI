<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table){   
          $table->bigIncrements('idUsuario');
          $table->bigInteger('idPersona')->unsigned();
          $table->string('usuario', 50);
          $table->string('contrasena', 50);
          $table->string('estado', 50);
          $table->boolean('condicion')->default(1);
          $table->timestamps();
          
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
        Schema::dropIfExists('usuarios');
    }
}
