<?php

namespace App\Services;

use App\Http\Helper\conversorHorariosSegundos;
use App\Models\{Responsavel , agendamentos, Datas, Horarios};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class criadorAgendamentos  
{
   public function criarAgendamento($req)
   {
     $nome = $req->nome; 
     $email = $req->email;
     $telefone = $req->telefone;
     $data = $req->data;
     $horarios = $req->horarios;
     $descricao = $req->obs;
     $espacoID = intval($req->espacoID);
     $nome_evento = $req->nome_evento;
     $publico = $req->publico;
     
     DB::beginTransaction();


     $horarios = explode(',' , $horarios);
     sort($horarios); //Organiza em valor crescente o vetor

     $hInicio = Horarios::select('horarios')->where([
         ['dia_Semana',  date('w', strtotime($data))],
         ['id',  $horarios[0]],
         ])->get();
      $hInicio = $hInicio[0]->horarios;

      $hFIm = Horarios::select('horarios')->where([
         ['dia_Semana',  date('w', strtotime($data))],
         ['id',  $horarios[count($horarios)-1]],
         ])->get();
      $hFIm = $hFIm[0]->horarios;

      $agendamento = agendamentos::create([
         'descricao' => $descricao,
         'nome' => $nome_evento,
         'tempo_inicial' => "$data $hInicio",
         'inicial_segundos' => conversorHorariosSegundos::converter($hInicio),
         'tempo_final' => "$data $hFIm",
         'final_segundos' => conversorHorariosSegundos::converter($hFIm),
         'publico' => ($publico == "on"),
         'email_conta' => Auth::user()->email,
         ]);


      
      $responsavel = $agendamento->responsavel()->create([
      'nome' => $nome,
      'email' => $email,
      'telefone' => $telefone
      ]);

      $espaco = $agendamento->Espacos()->attach([
         'espacos_id' => $espacoID
      ]);


      $this->criarRecursos($agendamento, $req);
      $this->criarServicos($agendamento, $req);
      $this->criarStaff($agendamento, $req);
    
    DB::commit(); //DB::rollBack();
    return $agendamento->id;

   }

   public function criarHorarios($agendamento, $req, $data)
   {  
      $horarios = $req->horarios;
      $horarios = explode(',' , $horarios);
      
      foreach($horarios as $horario)
         {
             $agendamento->Horarios()->attach([
              'horarios_id' => intval($horario)
              
            ]);
         }
   }


   public function criarRecursos($agendamento, $req)
   {
      if ($req->has(['recAVID'])) {
         $recAVID = $req->recAVID;
         foreach($recAVID as $recAVID_)
         {
            $recursosAudioVisuais = $agendamento->RecursosAudioVisuais()->attach([
              'recaudiovisuais_id' => $recAVID_
            ]);
         }
      }
   }

   public function criarServicos($agendamento, $req)
   {
      if ($req->has(['servExID'])) {
         $servExID = $req->servExID;
         foreach($servExID as $servExID_)
         {
            $servicosExtras = $agendamento->ServicosExtras()->attach([
              'servicosextras_id' => $servExID_
            ]);
         }
      }
   }

   public function criarStaff($agendamento, $req)
   {
      if ($req->has(['staffID'])) {
         $staffID = $req->staffID;
         foreach($staffID as $staffID_)
         {
            $staff = $agendamento->Staff()->attach([
              'staff_id' => $staffID_
            ]);
         }
      }
   }

}
