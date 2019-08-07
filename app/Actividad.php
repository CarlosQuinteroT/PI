<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $primaryKey = 'idActividad';
    protected $fillable = ['idCurso', 'descripcion', 'condicion'];
}
