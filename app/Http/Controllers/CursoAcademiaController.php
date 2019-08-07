<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoAcademia;
use App\Academias;
class CursoAcademiaController extends Controller
{
  //     FUNCION INDEX QUE SIRVE PARA TRAER Y MOSTRAR LOS REGISTROS DE LA BASE DE DATOS EN UNA TABLA

  public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $cursosacademias = CursoAcademia::orderBy('idCursoAcademia', 'desc')->paginate(3); 
        }
        else{
        $cursosacademias = CursoAcademia::where($criterio, 'like', '%', $buscar, '%')->orderBy('idCursoAcademia', 'desc')->paginate(3);
        }
      
       
        return [
            'pagination' => [
                'total'        => $cursosacademias->total(),
                'current_page' => $cursosacademias->currentPage(),
                'per_page'     => $cursosacademias->perPage(),
                'last_page'    => $cursosacademias->lastPage(),
                'from'         => $cursosacademias->firstItem(),
                'to'           => $cursosacademias->lastItem(),
          ],
          'cursosacademias' => $cursosacademias
        ];
    }
  
    public function getIdCursoAcademia(Request $request){
      $id_curso = $request->curso_id;
      $id_academia = $request->idAcademiass;
      
      $cursosacademias = CursoAcademia::select('cursosAcademias.idCursoAcademia')
        ->where('cursosAcademias.idAcademia', '=', ''.$id_academia)
        ->where('cursosAcademias.idCurso', '=', ''.$id_curso)->get();
      
      return['cursosacademias' => $cursosacademias];
      
    }
//   FUNCION QUE SIRVE PARA ALMACENAR UN REGISTRO NUEVO EN LA BASE DE DATOS
    public function store(Request $request)
    {
        $cursosacademias = new CursoAcademia();   
        $cursosacademias->idAcademia = $request->idAcademia;
        $cursosacademias->idCurso = $request->idCurso;       
        $cursosacademias->save();
    }
    
 
//   FUNCION QUE TRAE EL NOMBRE DE LAS ACADEMIAS EN BASE AL AID QUE MANDEMOS
     public function selectInfoCursoAcademia(Request $request){
       $idCurso = $request->idCurso;
    $cursosacademias = CursoAcademia::join('academias', 'cursosAcademias.idAcademia', '=', 'academias.idAcademia')
          ->select('cursosAcademias.idCursoAcademia', 'cursosAcademias.idAcademia', 
                   'academias.nombre','cursosAcademias.condicion')
    ->where('cursosAcademias.idCurso', '=', ''.$idCurso)->get(); 
    
    return ['cursosacademias' => $cursosacademias];

  }

}
