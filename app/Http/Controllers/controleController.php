<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\agendamentos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class controleController extends Controller
{
    public function index(Request $req)
    {
        $usuariosComuns = User::where('suporte', false);
        $usuariosSuportes = User::where('suporte', true);

        $agendamentos = Agendamentos::with('RecursosAudioVisuais' , 'ServicosExtras' , 'Staff', 'Espacos', 'responsavel')
        ->orderBy('tempo_inicial')
        ->get();

        $hoje = Carbon::now();

        return view('controle.index' , [
            'agendamentos' => $agendamentos,
            'hoje' => $hoje,
            'usuariosComuns' => $usuariosComuns,
            'usuariosSuportes' => $usuariosSuportes
    ]);
    }
}
