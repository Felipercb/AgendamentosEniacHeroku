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
                "name" => "Felipe Borges",
                "email" => "felipercborges@gmail.com",
                "password" => "eyJpdiI6ImxJZjZyMHcxaTVGQ21VNk9xTW9hQWc9PSIsInZhbHVlIjoiT2ZuNThpZll0bVcwQW9aYkd6dElxSG40S3I5bmhNdkZSRkozQ3pFa1hZcz0iLCJtYWMiOiIzNWE1MjFkNGRiNTdjMGRjMDQwYjE5YTBiOWQyYjI0YTQwMmZhOWJmOWZiYTJjN2FkMDZmNWY5YTMzNDcwYzllIiwidGFnIjoiIn0=",
                "name" => "Felipe Roberto",
                "admin" => 1,
                "suporte" => 1
        ]);        
        DB::commit();

    }
}
