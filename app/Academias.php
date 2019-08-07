<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academias extends Model
{
    //     HACVEMOS REFERECNAIA A LA TABLA Y A TODOS SUS CAMPOS EN LA BASE DE DATOS

    protected $table = 'academias';
    protected $primaryKey = 'idAcademia';
    protected $fillable = ['idContacto', 'nombre', 'telefono', 'direccion', 'estado', 'condicion'];
  
  public function contactos(){
      return $this->hasMany('App\Contacto');
    }
}
