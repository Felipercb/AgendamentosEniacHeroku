<?php

namespace App\Http\Controllers;

use App\Models\agendamentos;
use Illuminate\Http\Request;

class homeController extends Controller
{

   public function __construct()
   {
      // $this->middleware('auth');
   }

    public function index(Request $req)
    {
        $agendamentos = agendamentos::where('publico', 1)->with('RecursosAudioVisuais' , 'ServicosExtras' , 'Staff', 'Espacos', 'responsavel')->get();
        //dd($agendamentos);
        return view('home.index' , [
            'agendamentos' => $agendamentos,

    ]);
    }
}







    