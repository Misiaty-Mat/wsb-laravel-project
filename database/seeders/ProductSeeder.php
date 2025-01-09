<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = DB::table('product')->exists();

        if (!$exists) {
            DB::table('product')->insert([
                'product_name' => 'Computer mouse',
                'description' => 'Simple computer mouse for everyday life',
                'price' => 30.99,
                'stock' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('product')->insert([
                'product_name' => 'Keyboard',
                'description' => 'Mechanical keyboard with RGB lights',
                'price' => 89.99,
                'stock' => 555,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('product')->insert([
                'product_name' => 'Headphones',
                'description' => 'With built-in microphone and muffling surrounding sound',
                'price' => 185.49,
                'stock' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
