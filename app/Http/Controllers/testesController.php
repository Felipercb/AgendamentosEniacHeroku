<?php

namespace App\Http\Controllers;

use App\Models\config_horarios;
use App\Models\ConfiguracaoHorarios;
use App\Models\Horarios;
use Carbon\Carbon;
use Illuminate\Http\Request;

class testesController extends Controller
{
    public function testes($diasemana)
    {
        //$mytime = Carbon::now();
        //dd($mytime->format('m'));
        //dd($req->session()->get('valores'));
        
        //dd(Horarios::segunda()->get());

        return response (ConfiguracaoHorarios::where('id_semana' , '=' , $diasemana)->first());
        

        //$agendamentos = agendamentos::where('publico', 1)->with('RecursosAudioVisuais' , 'ServicosExtras' , 'Staff', 'Espacos', 'responsavel')->get();

    }
}
