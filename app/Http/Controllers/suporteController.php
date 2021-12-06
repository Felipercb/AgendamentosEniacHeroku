<?php

namespace App\Http\Controllers;

use agendamentos as GlobalAgendamentos;
use App\Models\Agendamentos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class suporteController extends Controller
{
    public function index()
    {
        $hoje = Carbon::now();
        $hoje_mais_duas_semanas = Carbon::now()->addDays(14);

        $agendamentos = agendamentos::where([
            ['tempo_inicial', '>=', $hoje],
            ['tempo_inicial', '<=', $hoje_mais_duas_semanas]
        ])
        ->orderBy('tempo_inicial')
        ->get();

        return view('suporte.index', [
            'agendamentos' => $agendamentos,
        ]);
    }

    public function responsavel(Request $request) {

        DB::beginTransaction();
        $agendamento = agendamentos::find($request->id);
        $agendamento->suporte_id = Auth::user()->id;
        $agendamento->save(); 
        DB::commit();

        return redirect()->route('suporte');
                            
        }  
        
    public function remover_responsabilidade(Request $request) {

        DB::beginTransaction();
        $agendamento = agendamentos::find($request->id);
        $agendamento->suporte_id = null;
        $agendamento->save();
        DB::commit();

        return redirect()->route('suporte');
                            
        }

    public function consulta(Request $request) {

        $agendamentos = agendamentos::where('id', $request->id)->with('RecursosAudioVisuais' , 'ServicosExtras' , 'Staff', 'Espacos', 'responsavel')->get();

        return view('suporte.index', compact('agendamentos'));

        }

    }
