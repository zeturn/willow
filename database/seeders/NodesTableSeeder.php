<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Node; // 假设您的模型在App\Models下

class NodesTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Node::create([
                'name' => 'Node ' . $i,
                'description' => 'Description for Node ' . $i . ', have a good day!',
                'status' => 5, // 或者任何您想要的默认状态
            ]);
        }
    }
}
//php artisan db:seed --class=NodesTableSeeder