<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Academias;

class AcademiaController extends Controller
{

//     FUNCION INDEX QUE SIRVE PARA TRAER Y MOSTRAR LOS REGISTROS DE LA BASE DE DATOS EN UNA TABLA
    public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
      
        if($buscar == ''){
          $academias = Academias::join('contactos', 'academias.idAcademia', '=', 'contactos.idContacto')
            ->join('personas', 'contactos.idPersona', '=', 'personas.idPersona')
            ->select('academias.idAcademia', 'academias.idContacto', 'academias.nombre', 'academias.telefono',
                   'academias.direccion',   'academias.condicion', 'academias.estado',
                   'contactos.idContacto', 'personas.nombre as personas_nombre')->orderBy('academias.idAcademia', 'desc')->paginate(3);

        }
        else{
        $academias = Academias::join('contactos', 'academias.idAcademia', '=', 'contactos.idContacto')
            ->join('personas', 'contactos.idPersona', '=', 'personas.idPersona')
            ->select('academias.idAcademia', 'academias.idContacto', 'academias.nombre', 'academias.telefono',
                   'academias.direccion',   'academias.condicion', 'academias.estado',
                   'contactos.idContacto', 'personas.nombre as personas_nombre')
            ->where('academias.'.$criterio, 'like', '%', $buscar, '%')
            ->orderBy('academias.idAcademia', 'desc')->paginate(3); 
        }
        
        return [
            'pagination' => [
                'total'        => $academias->total(),
                'current_page' => $academias->currentPage(),
                'per_page'     => $academias->perPage(),
                'last_page'    => $academias->lastPage(),
                'from'         => $academias->firstItem(),
                'to'           => $academias->lastItem(),
          ],
          'academias' => $academias
        ];
    }
  
//   CUENTA EL NUMERO DE REGISTROS QUE HAY EN LA TABLA DE ACADEMIAS PARA MOSTRARLO EN EL DASHBOARD
     public function contadorAcademia(){
      $academias = Academias::count();
      return ['academias' => $academias];
  }

//  FUNCION QUE SIRVE PAR ALMACENAR UN NUEVO REGISTRO EN LA TABLA DE ACADEMIAS
    public function store(Request $request)
    {
        
        $academias = new Academias();   
        $academias->nombre = $request->nombre;
        $academias->telefono = $request->telefono;
        $academias->direccion = $request->direccion;
        $academias->idContacto = $request->idContacto;
        $academias->estado = $request->estado;
        $academias->save();
      
    }
//  FUNCION QUE SIRVE PARA TRAE LAS ACADEMIAS QUE TIENEN LA CONDICIUON EN UNO, DANDO A ENTENDER QUE ESTA ENCENDIA
    public function selectAcademia(Request $request){
    $academias = Academias::where('condicion', '=', '1')->select('idAcademia', 'nombre')->orderBy('nombre', 'asc')->get();
    
      return ['academias' => $academias];
  }
//  FUNCION QUE SIRVE PARA ACTUALIZAR UNA ACADEMIA
    public function update(Request $request)
    {
       
      
        $academias = Academias::findOrFail($request->idAcademia);   
        $academias->nombre = $request->nombre;
        $academias->telefono = $request->telefono;
        $academias->direccion = $request->direccion;
        $academias->idContacto = $request->idContacto;
        $academias->estado = $request->estado;
        $academias->save();
    }
//   FUNCION QUE SIRVE PARA DESACTIVAR UN REGISTRO DE ACADEMIAS
    public function desactivar(Request $request)
    {
          $academias = Academia::findOrFail($request->idAcademia);        
          $academias->condicion = '0';
          $academias->save();
    }
//   FUNCION QUE SIRVE PARA ACTIVAR UN REGISTRO DE ACADEMIAS
    public function activar(Request $request)
    {
          $academias = Academia::findOrFail($request->idAcademia);        
          $academias->condicion = '1';
          $academias->save();
        
    }


    
}
