<?php

namespace App\Http\Controllers;

use App\Models\agendamentos;
use Illuminate\Http\Request;

class homeController extends Controller
{

   public function __construct()
   {

   }

    public function index(Request $req)
    {
        $agendamentos = Agendamentos::where('publico', 1)->with('RecursosAudioVisuais' , 'ServicosExtras' , 'Staff', 'Espacos', 'responsavel')->get();
        return view('home.index' , [
            'agendamentos' => $agendamentos,

    ]);
    }
}







    