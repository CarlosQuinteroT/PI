<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if($buscar == ''){
          $tickets = Ticket::join('personas', 'tickets.idPersona', '=', 'personas.idPersona')
          ->select('tickets.idTicket', 'tickets.idPersona','tickets.asunto','tickets.descripcion',
                     'personas.nombre','tickets.fecha_y_hora','tickets.condicion')->orderBy('tickets.idTicket', 'desc')->paginate(3); 
        }
        else{
        $tickets = Ticket::join('personas', 'tickets.idPersona', '=', 'personas.idPersona')
            ->select('tickets.idTicket', 'tickets.idPersona', 'tickets.descripcion',
                     'personas.nombre', 'tickets.asunto','tickets.fecha_y_hora', 'tickets.condicion')
            ->where('tickets.'.$criterio, 'like', '%', $buscar, '%')
            ->orderBy('tickets.idTicket', 'desc')->paginate(3); 
        }
       
        return [
            'pagination' => [
                'total'        => $tickets->total(),
                'current_page' => $tickets->currentPage(),
                'per_page'     => $tickets->perPage(),
                'last_page'    => $tickets->lastPage(),
                'from'         => $tickets->firstItem(),
                'to'           => $tickets->lastItem(),
          ],
          'tickets' => $tickets
        ];
    }

 
    public function store(Request $request)
    {
        
        $tickets = new Ticket();   
        $tickets->idPersona = $request->idPersona;
        $tickets->asunto = $request->asunto;
        $tickets->descripcion = $request->descripcion;
        $tickets->fecha_y_hora = $request->fecha_y_hora;
        $tickets->save();
      
    }

 
    public function update(Request $request)
    {
        $tickets = Ticket::findOrFail($request->idTicket);   
        $tickets->idPersona = $request->idPersona;
        $tickets->asunto = $request->asunto;
        $tickets->descripcion = $request->descripcion;
        $tickets->fecha_y_hora = $request->fecha_y_hora;
        $tickets->save();
    }
  
   public function desactivar(Request $request)
    {
          $tickets = Ticket::findOrFail($request->idTicket);        
          $tickets->condicion = '0';
          $tickets->save();
    }
  
    public function activar(Request $request)
    {
          $tickets = Ticket::findOrFail($request->idTicket);        
          $tickets->condicion = '1';
          $tickets->save();
        
    }
}
