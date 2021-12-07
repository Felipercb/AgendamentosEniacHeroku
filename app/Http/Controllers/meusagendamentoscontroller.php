<?php

namespace App\Http\Controllers;

use App\Models\agendamentos;
use App\Models\Responsavel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class meusagendamentoscontroller extends Controller
{
    public function index(Request $req)
    {
        $agendamentos = Agendamentos::where('email_conta', Auth::user()->email)->with('RecursosAudioVisuais' , 'ServicosExtras' , 'Staff', 'Espacos', 'responsavel')
        ->orderBy('tempo_inicial')
        ->get();

        $hoje = Carbon::now();
        

        return view('meusAgendamentos.index' , [
            'agendamentos' => $agendamentos,
            'hoje' => $hoje
    ]);
    }
        
}

