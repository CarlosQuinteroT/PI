<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoInstructor extends Model
{
    //
    protected $table = 'cursosinstructores';
    protected $primaryKey = 'idCursoInstructor';
    protected $fillable = ['idPersona', 'idCurso', 'estado', 'condicion'];
  
}
