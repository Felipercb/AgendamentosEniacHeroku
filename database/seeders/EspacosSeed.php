<?php

namespace Database\Seeders;

use App\Models\Espacos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspacosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::beginTransaction();
            Espacos::create(["espaco" => "Auditório Renata O. Way (Completo)"]);
            Espacos::create(["espaco" => "Sala Daniel Lopes (Parte das cadeiras fixas)"]);
            Espacos::create(["espaco" => "Sala Lenice Sampaio (Parte do palco)"]);
        DB::commit();
    }
}
