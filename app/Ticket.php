<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'idTicket';
    protected $fillable = ['idPersona', 'asunto', 'descripcion', 'fecha_y_hora', 'condicion'];
      
      
    public function personas(){
      return $this->hasMany('App\Persona');
    }
}
