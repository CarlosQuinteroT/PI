<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademiaInstructor extends Model
{
//     HACVEMOS REFERECNAIA A LA TABLA Y A TODOS SUS CAMPOS EN LA BASE DE DATOS
    protected $table = 'academiasInstructores';
    protected $primaryKey = 'idAcademiaInstructor';
    protected $fillable = ['idAcademia', 'idPersona', 'condicion'];
  
}
