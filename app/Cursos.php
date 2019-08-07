<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'idCurso';
    protected $fillable = ['nombreCurso', 'costo', 'fechaInicio', 'fechaFin', 'condicion'];
  
    public function instructores(){
      return $this->hasMany('App\Instructor');
    }
}
