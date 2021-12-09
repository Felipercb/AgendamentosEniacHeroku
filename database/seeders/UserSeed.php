<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::beginTransaction();
            User::create([
                "name" => "Felipe Roberto",
                "email" => "212382018@eniac.edu.br",
                "password" => "1234",
                "name" => "Felipe Roberto",
                "admin" => 1,
                "suporte" => 1
        ]);        
        DB::commit();

    }
}
