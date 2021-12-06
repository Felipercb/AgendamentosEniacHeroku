<?php

namespace App\Http\Controllers;

use App\Models\ { ConfiguracaoHorarios, Espacos , Staff , RecAudioVisuais , ServicosExtras, User};
use App\Services\atualizadorDeHorarios;
use App\Services\paginaConfiguracoes;
use Illuminate\Http\Request;


class configuracoesController extends Controller
{
    public function index(Request $req)
    {

            $espacos = Espacos::query()->orderBy('espaco')->get();
            $recAV = RecAudioVisuais::query()->orderBy('nome')->get();
            $servEx = ServicosExtras::query()->orderBy('nome')->get();
            $staff = Staff::query()->orderBy('nome')->get();
            $config_horarios = ConfiguracaoHorarios::orderBy('id_semana')->get();
            //dd($config_horarios);
            return view('configuracoes.index', [
                'espacos' => $espacos, 
                'recAV' => $recAV,
                'servEx' => $servEx,
                'staff' => $staff,
                'config_horarios' => $config_horarios
            ] );
        
    }

    public function atualize(Request $req , paginaConfiguracoes $banco, atualizadorDeHorarios $hora)
    {   
            switch($req->forma)
            {
                case 'modificar' : $banco->atualizar($req->tipo , $req->id , $req->valor); break;
                case 'adicionar' : $banco->adicionar($req->tipo , $req->valor);            break;
                case 'remover'   : $banco->remover($req->tipo , $req->id);                 break;
                case 'horarios'  : $hora->atualizar($req);                                 break;
            }
    }


                    
}