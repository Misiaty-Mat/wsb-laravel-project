<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sprawdzenie, czy administrator już istnieje
        $exists = DB::table('users')->where('email', 'admin@email.com')->exists();

        if (!$exists) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'admin@email.com',
                'role' => 'admin',
                'password' => Hash::make('supersecurepassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "Admin user dodany\n";
    }
}