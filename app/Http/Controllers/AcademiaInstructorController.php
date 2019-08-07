<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademiaInstructor;

class AcademiaInstructorController extends Controller
{
  //     FUNCION INDEX QUE SIRVE PARA TRAER Y MOSTRAR LOS REGISTROS DE LA BASE DE DATOS EN UNA TABLA

     public function index(Request $request)
    {
      
        $buscar = $request->buscar2;
        $criterio = $request->criterio2;
        $idAcademia = $request->idAcademia;
      
         if($buscar == ''){
          $academiasinstructores = AcademiaInstructor::join('personas', 'academiasInstructores.idPersona', '=', 'personas.idPersona')
          ->select('academiasInstructores.idAcademiaInstructor', 'academiasInstructores.idPersona',
                   'academiasInstructores.idAcademia',
                   'personas.nombre',  'personas.apellidoPaterno', 'personas.apellidoMaterno','academiasInstructores.condicion')->orderBy('academiasInstructores.idAcademiaInstructor', 'desc')->paginate(3); 
        }
       
        else{
        $academiasinstructores = AcademiaInstructor::join('personas', 'academiasInstructores.idPersona', '=', 'personas.idPersona')
          ->select('academiasInstructores.idAcademiaInstructor', 'academiasInstructores.idPersona',
                   'academiasInstructores.idAcademia',
                   'personas.nombre', 'personas.apellidoPaterno', 'personas.apellidoMaterno' , 'academiasInstructores.condicion')
            ->where('academiasInstructores.'.$criterio, 'like', '%', $buscar, '%')
            ->orderBy('academiasInstructores.idAcademiaInstructor', 'desc')->paginate(3); 
        }
      
       
        return [
            'pagination' => [
                'total'        => $academiasinstructores->total(),
                'current_page' => $academiasinstructores->currentPage(),
                'per_page'     => $academiasinstructores->perPage(),
                'last_page'    => $academiasinstructores->lastPage(),
                'from'         => $academiasinstructores->firstItem(),
                'to'           => $academiasinstructores->lastItem(),
          ],
          'academiasinstructores' => $academiasinstructores
        ];
    }
//   FUNCION QUE SRIVE PARA TRAER A LAS PERSONAS QUE ESTAN REGISTRADAS EN UNA ACADEMIA
  public function selectInfoAcademiaInstructor(Request $request){
       $idAcademia = $request->idAcademia;
    $academiasinstructores = AcademiaInstructor::join('personas', 'academiasInstructores.idPersona', '=', 'personas.idPersona')
          ->select('academiasInstructores.idAcademiaInstructor', 'academiasInstructores.idPersona',
                   'academiasInstructores.idAcademia',
                   'personas.nombre',  'personas.apellidoPaterno', 'personas.apellidoMaterno','academiasInstructores.condicion')
    ->where('academiasInstructores.idAcademia', '=', ''.$idAcademia)->get(); 
    
    return ['academiasinstructores' => $academiasinstructores];
  }
  
  
//   FUNCION QUE SIRVE PAR ALMACENAR PERSONAS EN UNA ACADEMIA
   public function store(Request $request)
    {
        
        $academiasinstructores = new AcademiaInstructor();   
        $academiasinstructores->idAcademia = $request->idAcademia;
        $academiasinstructores->idPersona = $request->idPersona;
        $academiasinstructores->save();

    }
//   FUNCION QUE SIRVE PARA ACTUALZIAR UN REGISTRO 
  public function update(Request $request)
    {
       
      
        $academiasinstructores = AcademiaInstructor::findOrFail($request->idAcademiaInstructor);   
        $academiasinstructores->idAcademia = $request->idAcademia;
        $academiasinstructores->idPersona = $request->idPersona;
        $academiasinstructores->save();
    }
  //   FUNCION QUE SIRVE PARA DESACTIVAR UN REGISTRO DE ACADEMIAS

  public function desactivar(Request $request)
    {
          $academiasinstructores = AcademiaInstructor::findOrFail($request->idAcademiaInstructor);        
          $academiasinstructores->condicion = '0';
          $academiasinstructores->save();
    }
  //   FUNCION QUE SIRVE PARA ACTIVAR UN REGISTRO DE ACADEMIAS

  public function activar(Request $request)
    {
          $academiasinstructores = AcademiaInstructor::findOrFail($request->idAcademiaInstructor);        
          $academiasinstructores->condicion = '1';
          $academiasinstructores->save();
        
    }
  
}
