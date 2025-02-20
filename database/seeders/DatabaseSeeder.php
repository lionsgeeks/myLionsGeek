<?php

namespace Database\Seeders;

use App\Models\Access;
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
        // User::factory(10)->create();

        User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Admin Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin@gmail.com',
            'cin' => 'BB000000',
            'phone' => '000000000',
            'status' => 'Working',
            // 'formation_id' => 1
        ]);
        
    }
}
