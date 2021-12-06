<?php

namespace Database\Seeders;

use App\Models\ConfiguracaoHorarios;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class configuracoesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        for($i = 0; $i < 8; $i++)
        {
            ConfiguracaoHorarios::create([
                "abertura" => "10:00",
                "fechamento" => "18:00",
                "periodo" => "01:00",
                "id_semana" => $i,
            ]);
        }
        DB::commit();
    }
}
