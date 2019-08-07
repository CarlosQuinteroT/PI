<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table){
          $table->bigIncrements('idTicket');
          $table->bigInteger('idPersona')->unsigned();
          $table->string('asunto', 250);
          $table->string('descripcion', 500);
          $table->date('fecha_y_hora');
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
        Schema::dropIfExists('tickets');
    }
}
