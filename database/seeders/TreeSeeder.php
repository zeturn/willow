<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trees')->insert([
            'id' => '48f9def3-19c6-4696-80cf-7ead08e6f300',
            'name' => 'Oak',
            'parent_id' => null, // Assuming this is a valid parent ID
            'description' => 'A large and sturdy tree.',
            'status' => 5
        ]);
    }
}
