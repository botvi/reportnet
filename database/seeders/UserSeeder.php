<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Admin",
            "username" => "admin",
            "password" => bcrypt('password'),
            "role" => "admin"
        ]);
        User::create([
            "name" => "Teknisi1",
            "username" => "teknisi1",
            "password" => bcrypt('password'),
            "role" => "teknisi"
        ]);
    }
}
