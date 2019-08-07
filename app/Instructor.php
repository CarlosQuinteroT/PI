<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    //     HACEMOS REFERECNAIA A LA TABLA Y A TODOS SUS CAMPOS EN LA BASE DE DATOS

      protected $table = 'instructores';
      protected $primaryKey = 'idInstructor';
      protected $fillable = ['idPersona', 'condicion'];
  
      public function personas(){
      return $this->hasMany('App\Persona');
        
     
    }
   public function curso(){
      return $this->belongTo('App\Instructor');
    }
  
  
}
