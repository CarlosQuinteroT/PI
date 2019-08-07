<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Persona;
class PersonaController extends Controller
{

    public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $personas = Persona::orderBy('idPersona', 'desc')->paginate(3); 
        }
        else{
        $personas = Persona::where($criterio, 'like', '%', $buscar, '%')->orderBy('idPersona', 'desc')->paginate(3);
        }
      
       
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
          ],
          'personas' => $personas
        ];
    }
  

  public function selectPersonas(Request $request){
    $personas = Persona::where('condicion', '=', '1')->select('idPersona', 'nombre')->orderBy('nombre', 'asc')->get();
    
      return ['personas' => $personas];
  }
  
  public function selectInfoPersona(Request $request){
    $idPersonaFin = $request->idPersona;
    $personas = Persona::select('nombre', 'telefono', 'email', 'direccion')
    ->where('personas.idPersona', '=', ''.$idPersonaFin)->orderBy('nombre', 'asc')->get();
    
      return ['personas' => $personas];
  }
  
  public function contadorPersona(){
      $personas = Persona::count();
      return ['personas' => $personas];
  }
    
  
    
  public function store(Request $request)
    {
        
        $personas = new Persona();   
        $personas->nombre = $request->nombre;
        $personas->apellidoPaterno = $request->apellidoPaterno;
        $personas->apellidoMaterno = $request->apellidoMaterno;
        $personas->direccion = $request->direccion;
        $personas->telefono = $request->telefono;
        $personas->email = $request->email;
        $personas->imagen = $request->imagen;
        $personas->save();
           
//            $personas = $request->all();
        
//            $nombre=$archivo->getClientOriginalName();
//            $archivo->move('images', $nombre);
//            $personas['imagen'] = $nombre;
      
//         Persona::create($personas);
    }

 
  public function update(Request $request)
    {
       
      
        $personas = Persona::findOrFail($request->idPersona);   
        $personas->nombre = $request->nombre;
        $personas->apellidoPaterno = $request->apellidoPaterno;
        $personas->apellidoMaterno = $request->apellidoMaterno;
        $personas->direccion = $request->direccion;
        $personas->telefono = $request->telefono;
        $personas->email = $request->email;
        $personas->imagen = $request->imagen;
        $personas->save();
    }
  
  public function desactivar(Request $request)
    {
          $personas = Persona::findOrFail($request->idPersona);        
          $personas->condicion = '0';
          $personas->save();
    }
  
  public function activar(Request $request)
    {
          $personas = Persona::findOrFail($request->idPersona);        
          $personas->condicion = '1';
          $personas->save();
        
    }

  
   
}
