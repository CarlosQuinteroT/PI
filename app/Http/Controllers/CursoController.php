<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Cursos;
class CursoController extends Controller
{

    public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $cursos = Cursos::orderBy('idCurso', 'desc')->paginate(3); 
        }
        else{
        $cursos = Cursos::where($criterio, 'like', '%', $buscar, '%')->orderBy('idCUrso', 'desc')->paginate(3);
        }
       
        return [
            'pagination' => [
                'total'        => $cursos->total(),
                'current_page' => $cursos->currentPage(),
                'per_page'     => $cursos->perPage(),
                'last_page'    => $cursos->lastPage(),
                'from'         => $cursos->firstItem(),
                'to'           => $cursos->lastItem(),
          ],
          'cursos' => $cursos
        ];
    }

     public function contadorCurso(){
      $cursos = Cursos::count();
      return ['cursos' => $cursos];
  }
 
    public function store(Request $request)
    {
        $cursos = new Cursos();   
        $cursos->nombreCurso = $request->nombreCurso;
        $cursos->costo = $request->costo;
        $cursos->fechaInicio = $request->fechaInicio;
        $cursos->fechaFin = $request->fechaFin;
        $cursos->save();

    }

 
    public function update(Request $request)
    {
       
      
        $cursos = Cursos::findOrFail($request->idCurso);   
        $cursos->nombreCurso = $request->nombreCurso;
        $cursos->costo = $request->costo;
        $cursos->fechaInicio = $request->fechaInicio;
        $cursos->fechaFin = $request->fechaFin;
        $cursos->save();
    }
  
   public function desactivar(Request $request)
    {
          $cursos = Cursos::findOrFail($request->idCurso);        
          $cursos->condicion = '0';
          $cursos->save();
    }
  
    public function activar(Request $request)
    {
          $cursos = Cursos::findOrFail($request->idCurso);        
          $cursos->condicion = '1';
          $cursos->save();
        
    }

  
   
}
