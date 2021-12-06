<?php

namespace Database\Seeders;

use App\Models\Staff;
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
            Staff::create(["nome" => "Bombeiro Civil"]);
            Staff::create(["nome" => "Limpeza"]);
            Staff::create(["nome" => "Recepcionista"]);
            Staff::create(["nome" => "Segurança"]);
            Staff::create(["nome" => "Suporte Técnico"]);
        DB::commit();
    }
}
