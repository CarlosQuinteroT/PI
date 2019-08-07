<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'idPersona';
    protected $fillable = ['nombre', 'apellidoPaterno', 'apellidoMaterno', 'direccion', 'telefono', 'email','condicion'];
    
    public function contacto(){
      return $this->belongsTo('App\Contacto');
    }
  
    public function ticket(){
      return $this->belongsTo('App\Ticket');
    }
  
    
  
}


