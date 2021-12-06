<?php

namespace Database\Seeders;

use App\Models\RecAudioVisuais;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecursosaudiovisuaisSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
            RecAudioVisuais::create(["nome" => "Computador"]);
            RecAudioVisuais::create(["nome" => "Microfone"]);
            RecAudioVisuais::create(["nome" => "Projetor e telão"]);
            RecAudioVisuais::create(["nome" => "Som"]);
            RecAudioVisuais::create(["nome" => "Vídeo"]);
        DB::commit();
    }
}
