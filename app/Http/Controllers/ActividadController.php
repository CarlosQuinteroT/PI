<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Actividad;
class ActividadController extends Controller
{

    public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $actividades = Actividad::join('cursos', 'actividades.idCurso', '=', 'cursos.idCurso')
          ->select('actividades.idActividad', 'actividades.idCurso', 'actividades.descripcion',
                     'cursos.nombreCurso', 'actividades.condicion')->orderBy('actividades.idActividad', 'desc')->paginate(3); 
        }
        else{
        $contactos = Actividad::join('cursos', 'actividades.idCurso', '=', 'cursos.idCurso')
          ->select('actividades.idActividad', 'actividades.idCurso', 'actividades.descripcion',
                     'cursos.nombreCurso', 'actividades.condicion')->orderBy('actividades.idActividad', 'desc')
            ->where('actividades.'.$criterio, 'like', '%', $buscar, '%')
            ->orderBy('actividades.idActividad', 'desc')->paginate(3); 
        }
        
        return [
            'pagination' => [
                'total'        => $actividades->total(),
                'current_page' => $actividades->currentPage(),
                'per_page'     => $actividades->perPage(),
                'last_page'    => $actividades->lastPage(),
                'from'         => $actividades->firstItem(),
                'to'           => $actividades->lastItem(),
          ],
          'actividades' => $actividades
        ];
    }

 
    public function store(Request $request)
    {
        
        $actividades = new Actividad();   
        $actividades->idCurso = $request->idCurso;
        $actividades->descripcion = $request->descripcion;      
        $actividades->save();

    }

 
    public function update(Request $request)
    {
       
      
        $actividades = Actividad::findOrFail($request->idActividad);   
        $actividades->idCurso = $request->idCurso;
        $actividades->descripcion = $request->descripcion; 
        $actividades->save();
    }
  
   public function desactivar(Request $request)
    {
          $actividades = Actividad::findOrFail($request->idActividad);        
          $actividades->condicion = '0';
          $actividades->save();
    }
  
    public function activar(Request $request)
    {
          $actividades = Actividad::findOrFail($request->idActividad);        
          $actividades->condicion = '1';
          $actividades->save();
        
    }

  
   
}
