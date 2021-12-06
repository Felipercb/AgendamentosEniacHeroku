<?php

namespace App\Http\Helper;

use Carbon\Carbon;

class conversorHorariosSegundos  
{  
   
   static public function converter($horario)
   {
      $horario = new Carbon($horario); 
      $horario = $horario->format('H:i');

      $vetor_horarios = explode(":" , $horario);

      $segundos_totais = (intval($vetor_horarios[0]) * 3600) + (intval($vetor_horarios[1]) * 60); 
      return $segundos_totais;
   }

}
