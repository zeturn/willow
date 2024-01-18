<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
        
        public function run()
        {
            // 调用其他 Seeder
            $this->call([
                UserSeeder::class,
                DiscussSeeder::class,
                EntrySeeder::class,
                TreeSeeder::class,
            ]);
        }
    
}
