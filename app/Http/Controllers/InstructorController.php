<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//   FUNCION QUE SIRVE PARA MOSTRAR LOS REGISTROS DE LA TABLA DE INSTRCUTORES EN L;A BASE DE DATOS
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
  
//   FUNCNON QUE SIRVE PARA TRAER LOS INSTRCUTORES QUE TIENEN UNO ES SU CONDICION 
    public function selectInstructor(Request $request){
       $instructores = Instructor::join('personas', 'instructores.idPersona', '=', 'personas.idPersona')
       ->select('instructores.idInstructor', 'personas.nombre', 'personas.direccion', 'personas.email')
       ->where('instructores.condicion', '=', '1')->get();
    
      return ['instructores' => $instructores];
    }
//   FUNCIION QUE SIRVE PARA TRTAER LAS PERSONAS QUE ESTAN EN LA TABLA INSTRRCUTORES
     public function selectInfoInstructor(Request $request){
       $idInstructorFin = $request->idInstructor;
       $instructor = Instructor::join('personas', 'instructores.idPersona', '=', 'personas.idPersona')
       ->select('instructores.idInstructor', 'personas.nombre', 'personas.direccion', 'personas.email', 'personas.telefono')
       ->where('instructores.idInstructor', '=', ''.$idInstructorFin)->orderBy('idInstructor', 'asc')->get();
    
      return ['instructores' => $instrucotres];
    }
//   FUNCION QUE SIRVE PARA CONTAR LOS REGISTROS DE LOS
    public function contadorInstructor(){
      $instructores = Instructor::count();
      return ['instructores' => $instructores];
    }

    public function selectContacto(Request $request){
       $contactos = Contacto::join('personas', 'contactos.idPersona', '=', 'personas.idPersona')
       ->select('contactos.idContacto', 'personas.nombre')
       ->where('contactos.condicion', '=', '1')->orderBy('nombre', 'asc')->get();
    
      return ['contactos' => $contactos];
    }
 
    public function store(Request $request)
    {
        
        $contactos = new Contacto();   
        $contactos->idPersona = $request->idPersona;
        $contactos->estado = $request->estado;
        $contactos->save();
      
    }

 
    public function update(Request $request)
    {
       
      
        $contactos = Contacto::findOrFail($request->idContacto);   
        $contactos->idPersona = $request->idPersona;
        $contactos->estado = $request->estado;
        $contactos->save();
    }
  
   public function desactivar(Request $request)
    {
          $contactos = Contacto::findOrFail($request->idContacto);        
          $contactos->condicion = '0';
          $contactos->save();
    }
  
    public function activar(Request $request)
    {
          $contactos = Contacto::findOrFail($request->idContacto);        
          $contactos->condicion = '1';
          $contactos->save();
        
    }
}
