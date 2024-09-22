<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where("email", "kim@gomes.com")->first()){
            User::create([
                "name" => "Akim",
                "email" => "kim@gomes.com",
                "password" => Hash::make("123456a", ["rounds" => 12]),
            ]);
        }
    }
}
