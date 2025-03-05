<?php

namespace Database\Seeders;

use App\Models\Access;
use App\Models\Formation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $formation = Formation::create([
            'id' => Str::uuid()->toString(),
            'class_name' => 'coding_1',
            'formation_name' => 'okokkok',
            'start_time' => '12/20/2000',
            'end_time' => '12/20/2005'
        ]);

        $admin = User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Admin Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin@gmail.com',
            'cin' => 'BB000000',
            'phone' => '000000000',
            'status' => 'Working',
            'formation_id' => $formation->id
        ]);
        Access::create([
            'user_id' => $admin->id,
            'role' => 'Moderator',
            'access_studio' => 1,
            'access_cowork' => 1,
        ]);
    }
}
