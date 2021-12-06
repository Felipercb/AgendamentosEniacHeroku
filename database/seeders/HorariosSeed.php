<?php

namespace Database\Seeders;

use App\Http\Helper\conversorHorariosSegundos;
use App\Models\Horarios;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorariosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     

    public function run()
    {
        $horariosPadrao = ["10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00"];
        

        DB::beginTransaction();
        for($i = 0; $i < 8; $i++)
        {   
            $num = 0;
            foreach($horariosPadrao as $horario)
            {
                Horarios::create([
                    "index" => $num,
                    "dia_Semana" => $i,
                    "horarios" => "$horario",
                    "horario_segundos" => conversorHorariosSegundos::converter($horario)
                ]);

                $num++;
            }
        }
        
        DB::commit();
    }
}
