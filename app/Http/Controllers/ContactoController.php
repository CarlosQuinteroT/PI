<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacto;
class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
//     FUNCION INDEX QUE REALIZA UN JOIN ENTRE LA TABLA CONTACTOS Y PERSONAS
    public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $contactos = Contacto::join('personas', 'contactos.idPersona', '=', 'personas.idPersona')
          ->select('contactos.idContacto', 'contactos.idPersona', 'contactos.estado',
                     'personas.nombre', 'contactos.condicion')->orderBy('contactos.idContacto', 'desc')->paginate(3); 
        }
        else{
        $contactos = Contacto::join('personas', 'contactos.idPersona', '=', 'personas.idPersona')
            ->select('contactos.idContacto', 'contactos.idPersona', 'contactos.estado',
                     'personas.nombre', 'contactos.condicion')
            ->where('contactos.'.$criterio, 'like', '%', $buscar, '%')
            ->orderBy('contactos.idContacto', 'desc')->paginate(3); 
        }
          
        return [
            'pagination' => [
                'total'        => $contactos->total(),
                'current_page' => $contactos->currentPage(),
                'per_page'     => $contactos->perPage(),
                'last_page'    => $contactos->lastPage(),
                'from'         => $contactos->firstItem(),
                'to'           => $contactos->lastItem(),
          ],
          'contactos' => $contactos
        ];
    }
  
  public function contadorContactos(){
    
      $contactos = Contacto::count();
      return ['contactos' => $contactos];
  }
  

//     FUNCION QUE REALIZA JOIN CON LA TABLA CONTACTOS Y PERSONAS EN BASE A UNA CONDICION
    public function selectContacto(Request $request){
       $contactos = Contacto::join('personas', 'contactos.idPersona', '=', 'personas.idPersona')
       ->select('contactos.idContacto', 'personas.nombre', 'personas.direccion', 'personas.email')
       ->where('contactos.condicion', '=', '1')->orderBy('nombre', 'asc')->get();
    
      return ['contactos' => $contactos];
    }
  
//   FUCION QUE REALIZA UN JOIN Y TRAE UNA SOLA FILA EN BASE A UN ID RECIBIDO COMO PARAMETRO PARA MOSTRAR LAS PERSONAS QUE SON CONTACTOS
     public function selectInfoContacto(Request $request){
       $idContactoFin = $request->idContacto;
       $contactos = Contacto::join('personas', 'contactos.idPersona', '=', 'personas.idPersona')
       ->select('contactos.idContacto', 'personas.nombre', 'personas.direccion', 'personas.email', 'personas.telefono')
       ->where('contactos.idContacto', '=', ''.$idContactoFin)->orderBy('nombre', 'asc')->get();
    
      return ['contactos' => $contactos];
    }
  
//   FUNCION QUE ALMACENA O REGISTRA EN LA BASE DE DATOS
    public function store(Request $request)
    {
        
        $contactos = new Contacto();   
        $contactos->idPersona = $request->idPersona;
        $contactos->estado = $request->estado;
        $contactos->save();
      
    }

//  FUNCION QUE ACTUALIZA EN LA BASE DE DATOS
    public function update(Request $request)
    {
       
      
        $contactos = Contacto::findOrFail($request->idContacto);   
        $contactos->idPersona = $request->idPersona;
        $contactos->estado = $request->estado;
        $contactos->save();
    }
//   FUNCION PARA DESACTIVAR EL REGISTRO 
   public function desactivar(Request $request)
    {
          $contactos = Contacto::findOrFail($request->idContacto);        
          $contactos->condicion = '0';
          $contactos->save();
    }
//   FUNCION PARA ACTIVAR EL REGISTRO 
    public function activar(Request $request)
    {
          $contactos = Contacto::findOrFail($request->idContacto);        
          $contactos->condicion = '1';
          $contactos->save();
        
    }
}
