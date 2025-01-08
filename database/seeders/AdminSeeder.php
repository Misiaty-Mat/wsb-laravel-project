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
        echo "Uruchamianie AdminSeeder\n";
    
        DB::table('users')->updateOrInsert(
            ['email' => env('ADMIN_EMAIL', 'admin@email.com')],
            [
                'name' => 'Administrator',
                'role' => 'admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'supersecurepassword')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    
        echo "Admin user dodany\n";
    }
}