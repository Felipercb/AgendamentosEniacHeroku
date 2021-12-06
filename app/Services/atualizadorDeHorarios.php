<?php

namespace App\Services;

use App\Http\Helper\conversorHorariosSegundos;
use App\Models\{Responsavel , agendamentos, config_horarios, ConfiguracaoHorarios, Datas, Horarios};
use AppendIterator;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class atualizadorDeHorarios  
{
   public function atualizar($req)
   {
      $abertura = new Carbon($req->timeAbertura); //Recebo a hora de abertura e instancio o carbon
      $fechamento = new Carbon($req->timeFechamento); //Mesma coisa para fechamento 
      $periodo = $req->periodo;
      $idconfig = $req->idconfig;
      $idSemana = $req->idSemana;
      $diaDisponivel = $req->diaDisponivel;

      $bancoHorarios = Horarios::where('dia_Semana' , $idSemana)->get();

      //Garanto que está vindo no formato hora:minuto , sem os segundos
      $abertura = $abertura->format('H:i'); 
      $fechamento = $fechamento->format('H:i');

      $temp = 0; //Variável para armazenar quanto é o passo de tempo
      $index = 0; //Váriável que será o index de cada horário, utilizado na hora da exibição dos horários
       
      $fechamento_ = explode(':', $fechamento); //Separação da hora de fechamento em um vetor com [hora, minuto]
      //O passo de tempo chegará com um número, onde cada um tem um valor em minutos
      switch($periodo){
         case 0: $temp = 15; break; //15 minutos
         case 1: $temp = 30; break; //30 minutos 
         case 2: $temp = 60; break; //1 hora / 60 minutos
      }
      
      
      
      $time = Carbon::createFromFormat('H:i', $abertura)->format('H:i');//Criação de uma variável onde vão ser somados os passos
      $valores = []; //Vetor que irá guardar a lista de horários criada

      $hExplode = explode(':', $time);//Separação do da variável em um vetor [hora , minuto] para facilitar a comparação
      array_push($valores , $time); //Primeiro valor de hora adicionado ao vetor
      
      //$time = Carbon::createFromFormat('H:i', $abertura)->format('H:i');

      while(intval($fechamento_[0]) > intval($hExplode[0])){ //Loop que vai criar a lista com os horários disponíveis
         
         $time = Carbon::createFromFormat('H:i', $time)->addMinutes($temp)->format('H:i'); //è adicionado o passo em cima do ulrimo horário criado
         $hExplode = explode(':', $time); //Esse novo horário é separado em um vetor [hora , minuto] 

         /*
            Verificação dos minutos, isso serve para que caso a soma do passo no ultimo horário passe alguns minutos do fechamento
         essa soma seja cancelada o o ulrimo horário seja o próprio fechamento (mesmo que o passo não seja respeitado.)         
         */
         if((intval($fechamento_[0]) == intval($hExplode[0])) && (intval($fechamento_[1]) < intval($hExplode[1]))) 
         {
            array_push($valores , $fechamento);
            break;
         }

         array_push($valores , $time); //Adiciona o horário criado ao vetor de horários disponíveis
      }


      DB::beginTransaction();

      Horarios::where('dia_Semana' , $idSemana)->delete();

      foreach($valores as $valor) //Adiciona os novos valores em ordem, com um index, seguindo o vetor criado anteriormente
      {
         Horarios::create([
            'horarios' => $valor,
            'index' => $index,
            'dia_Semana' => $idSemana,
            'horario_segundos' => conversorHorariosSegundos::converter($valor),
         ]);
         $index++;
      }


      switch($periodo){ //Verificação período no formato H:m:s, para ser armazenado no banco e ter a configuração salva
         case 0: $periodo = '00:15:00'; break;
         case 1: $periodo = '00:30:00'; break;
         case 2: $periodo = '01:00:00'; break;
      }

      //Salvando as configurações novas dos horários na tabela de configurações
      $config = ConfiguracaoHorarios::where('id_semana' , $idSemana)->first();
      $config->abertura = $abertura;
      $config->fechamento = $fechamento;
      $config->periodo = $periodo;
      $config->disponivel = ($diaDisponivel === "true");
      $config->save();

      DB::commit();

   }

}
