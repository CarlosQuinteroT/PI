<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\UserG;
class UserController extends Controller
{
    public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $users = UserG::orderBy('id', 'desc')->paginate(3); 
        }
      else{
        $users = UserG::where($criterio, 'like', '%', buscar, '%')->orderBy('id', 'desc')->paginate(3);
      }
        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
          ],
          'users' => $users
        ];
    }

 
    public function store(Request $request)
    {
//         if (!$request->ajax()) return redirect('/');
        $users = new UserG();
        $users->idrol = $request->idrol;
        $users->usuario = $request->usuario;
        $users->password = bcrypt($request->password);
        $users->save();
      
    }

 
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $users = UserG::findOrFail($request->id); 
        $users->usuario = $request->usuario;
        $users->password = bcrypt($request->password);
        $users->idrol = $request->idrol;
        $users->save();
    }
  
   public function desactivar(Request $request)
    {
          if (!$request->ajax()) return redirect('/');
          $users = UserG::findOrFail($request->id);        
          $users->condicion = '0';
          $users->save();
    }
  
    public function activar(Request $request)
    {
          if (!$request->ajax()) return redirect('/');
          $users = UserG::findOrFail($request->id);        
          $users->condicion = '1';
          $users->save();
        
    }
}
