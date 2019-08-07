<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoInstructor;
class CursoInstructorController extends Controller
{
     public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $cursosinstructores = CursoInstructor::join('cursosAcademias','cursosinstructores.idCursoAcademia', '=', 'cursosAcademias.idCursoAcademia')
         ->join('cursosinstructores.idPersona', '=', 'personas.idPersona')
         ->join('cursosAcademias.idAcademia', '=', 'academias.idAcademia')
         ->join('cursosAcademias.idCurso', '=', 'cursos.idCurso')
         ->select('cursosinstructores.idCursoInstructor',
                  'cursosinstructores.idCursoAcademia','personas.nombre as nombre_persona','cursosAcademias.idAcademia',
                  'academias.nombre as nombre_academia',
                  'cursos.nombre as nombre_curso',
                  'cursosinstructores.estado',
                  'cursosinstructores.condicion')->where($criterio, 'like', '%', $buscar, '%')
          ->orderBy('idCursoInstructor', 'desc')->paginate(3); 
        }
        else{
        $cursosinstructores = CursoInstructor::join('cursosAcademias','cursosinstructores.idCursoAcademia', '=', 'cursosAcademias.idCursoAcademia')
         ->join('cursosinstructores.idPersona', '=', 'personas.idPersona')
         ->join('cursosAcademias.idAcademia', '=', 'academias.idAcademia')
         ->join('cursosAcademias.idCurso', '=', 'cursos.idCurso')
         ->select('cursosinstructores.idCursoInstructor',
                  'cursosinstructores.idCursoAcademia','personas.nombre as nombre_persona','cursosAcademias.idAcademia',
                  'academias.nombre as nombre_academia',
                  'cursos.nombre as nombre_curso',
                  'cursosinstructores.estado',
                  'cursosinstructores.condicion')
          ->where($criterio, 'like', '%', $buscar, '%')
          ->orderBy('idCursoInstructor', 'desc')->paginate(3);
        }
      
       
        return [
            'pagination' => [
                'total'        => $cursosinstructores->total(),
                'current_page' => $cursosinstructores->currentPage(),
                'per_page'     => $cursosinstructores->perPage(),
                'last_page'    => $cursosinstructores->lastPage(),
                'from'         => $cursosinstructores->firstItem(),
                'to'           => $cursosinstructores->lastItem(),
          ],
          'cursosinstructores' => $cursosinstructores
        ];
    }
  
  public function store(Request $request)
    {
        $cursosinstructores = new CursoInstructor();   
        $cursosinstructores->idPersona = $request->idPersona;
        $cursosinstructores->idCursoAcademia = $request->idCursoAcademia;
        $cursosinstructores->save();
    }
  
  public function selectInfoCursoInstructor(Request $request){
       $idCurso = $request->idCurso;
       $idCursoAcademia = $request->idCursoAcademia;
       $cursosinstructores = CursoInstructor::join('cursosAcademias',          'cursosinstructores.idCursoAcademia', '=', 'cursosAcademias.idCursoAcademia')
         ->join('cursos', 'cursosAcademias.idCurso', '=', 'cursos.idCurso')
         ->join('academias', 'cursosAcademias.idAcademia', '=', 'academias.idAcademia')
         ->join('personas', 'cursosinstructores.idPersona', '=', 'personas.idPersona')
         ->select('cursos.nombre as nombre_curso',
                  'academias.nombre as nombre_academia',
                  'personas.nombre as nombre_persona')
         ->where('cursosinstructores.idCursoAcademia', '=', ''.$idCursoAcademia)
         ->get(); 
    
    return ['cursosinstructores' => $cursosinstructores];

  }
  
  
}
