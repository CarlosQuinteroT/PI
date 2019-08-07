<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoAcademia extends Model
{
    //     HACEMOS REFERECNAIA A LA TABLA Y A TODOS SUS CAMPOS EN LA BASE DE DATOS

    protected $table = 'cursosAcademias';
    protected $primaryKey = 'idCursoAcademia';
    protected $fillable = ['idAcademia', 'idCurso', 'estado', 'condicion'];
  
}
