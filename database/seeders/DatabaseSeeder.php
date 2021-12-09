<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EspacosSeed::class,
            HorariosSeed::class,
            RecursosaudiovisuaisSeed::class,
            ServicosextrasSeed::class,
            StaffSeed::class,
            configuracoesSeed::class,
            UserSeeder::class
        ]);
    }
}
