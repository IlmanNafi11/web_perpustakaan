<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table("users")->insert([
        //     "name" => "ilmannafi",
        //     "email"=> "masmanku03@gmail.com",
        //     "password"=> bcrypt("password"),
        //     "address"=> "sragen, jawa tengah",
        //     "phone"=> "085123456789",
        //     "photo_path"=> "default",
        //     "email_verified_at" => now(),
        //     "created_at" => now(),
        //     "updated_at" => now(),
        //     "remember_token" => Str::random(10),
        // ]);

        User::factory(50)->create();
    }
}
