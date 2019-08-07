<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
  //     HACEMOS REFERECNAIA A LA TABLA Y A TODOS SUS CAMPOS EN LA BASE DE DATOS

    protected $table = 'contactos';
    protected $primaryKey = 'idContacto';
    protected $fillable = ['idPersona', 'estado', 'condicion'];
  
    public function personas(){
      return $this->hasMany('App\Persona');
    }
  
   public function instructor(){
      return $this->belongsTo('App\Instructor'); 
    }
  
    public function academia(){
      return $this->belongsTo('App\Academias');
    }
    
}
