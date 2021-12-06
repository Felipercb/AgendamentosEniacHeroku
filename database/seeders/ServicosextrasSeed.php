<?php

namespace Database\Seeders;

use App\Models\ServicosExtras;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicosextrasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
            ServicosExtras::create(["nome" => "Almoço"]);
            ServicosExtras::create(["nome" => "Coffee Break"]);
            ServicosExtras::create(["nome" => "Traslados"]);
            ServicosExtras::create(["nome" => "Welcome coffee"]);
        DB::commit();
    }
}
