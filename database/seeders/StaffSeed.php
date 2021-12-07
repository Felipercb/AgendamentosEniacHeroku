<?php

namespace Database\Seeders;

use App\Models\staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
            staff::create(["nome" => "Bombeiro Civil"]);
            staff::create(["nome" => "Limpeza"]);
            staff::create(["nome" => "Recepcionista"]);
            staff::create(["nome" => "Segurança"]);
            staff::create(["nome" => "Suporte Técnico"]);
        DB::commit();
    }
}
