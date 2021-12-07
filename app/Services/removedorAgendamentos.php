<?php

namespace App\Services;


use App\Models\{Responsavel , agendamentos, Espacos, EspacosList, RecursosAudioVisuais, RecursosAudioVisuaisList, ServicosExtras, ServicosExtrasList, staff, StaffList};
use Illuminate\Support\Facades\DB;
use Responsavel as GlobalResponsavel;

class removedorAgendamentos  
{
   public function apagarAgendamento($agendamento_id)
   {
      DB::beginTransaction();
      $agendamento = Agendamentos::find($agendamento_id);
      $agendamento->RecursosAudioVisuais()->detach();
      $agendamento->ServicosExtras()->detach();
      $agendamento->Staff()->detach();
      $agendamento->Espacos()->detach();
      $agendamento->responsavel->delete();
      $agendamento->delete();
      DB::commit(); 
   }
}
