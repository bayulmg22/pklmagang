<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@dinsos.lamongankab.go.id',
            'password' => bcrypt('password'), // or Hash::make('password')
            'role' => 'admin',
            'status' => 'approved',
        ]);
    }
}
