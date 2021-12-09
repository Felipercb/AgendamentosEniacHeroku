<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\agendamentos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class controleController extends Controller
{
    public function index(Request $req)
    {
        $agendamentos = Agendamentos::with('RecursosAudioVisuais' , 'ServicosExtras' , 'Staff', 'Espacos', 'responsavel')
        ->orderBy('tempo_inicial')
        ->get();

        $hoje = Carbon::now();

        return view('controle.index' , [
            'agendamentos' => $agendamentos,
            'hoje' => $hoje
    ]);
    }
}
