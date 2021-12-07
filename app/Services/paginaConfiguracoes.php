<?php

namespace App\Services;


use App\Models\{ Espacos, RecAudioVisuais, ServicosExtras, staff};
use Illuminate\Support\Facades\DB;
use Responsavel as GlobalResponsavel;

class paginaConfiguracoes  
{
   public function adicionar($tipo , $valor)
   {
      DB::beginTransaction();
      switch($tipo)
        {
            case 'espaco': 
            $espaco = Espacos::create(['espaco' => $valor]);
            break;
            case 'recAv': 
            $espaco = RecAudioVisuais::create(['nome' => $valor , 'descricao' => '']);
            break;
            case 'servEx': 
            $espaco = ServicosExtras::create(['nome' => $valor , 'descricao' => '']);
            break;
            case 'staff': 
            $espaco = staff::create(['nome' => $valor , 'descricao' => '']);
            break;
        }
      DB::commit(); 
   }

   public function atualizar($tipo, $id , $valor)
   {
      DB::beginTransaction();
      switch($tipo){
        case 'espaco': 
            $espaco = Espacos::find($id);
            $espaco->espaco = $valor;
            $espaco->save();
        break;
        
        case 'recAv': 
            $recAV = RecAudioVisuais::find($id);
            $recAV->nome = $valor;
            $recAV->save();
        break;
        
        case 'servEx': 
            $servEx = ServicosExtras::find($id);
            $servEx->nome = $valor;
            $servEx->save();
        break;
        
        case 'staff': 
            $staff = staff::find($id);
            $staff->nome = $valor;
            $staff->save();
        break;
                        
    }               
      DB::commit(); 
   }

   public function remover($tipo, $id)
   {
      DB::beginTransaction();
      switch($tipo)
        {
            case 'espaco': 
            $espaco = Espacos::find($id);
            $espaco->delete();
            break;

            case 'recAv': 
            $espaco = RecAudioVisuais::find($id);
            $espaco->delete();
            break;

            case 'servEx': 
            $espaco = ServicosExtras::find($id);
            $espaco->delete();
            break;

            case 'staff': 
            $espaco = staff::find($id);
            $espaco->delete();
            break;
        }
      DB::commit(); 
   }
}
