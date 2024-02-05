<?php

namespace Database\Seeders;

// database/seeds/EdgesTableSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Edge;
use App\Models\Node;

class EdgesTableSeeder extends Seeder
{
    public function run()
    {
        $nodes = Node::all()->pluck('id')->toArray();
        $edgesToCreate = 80;
        $createdEdges = 0;

        while ($createdEdges < $edgesToCreate) {
            $startNode = $nodes[array_rand($nodes)];
            $endNode = $nodes[array_rand($nodes)];

            // 确保不会创建指向自身的边，也不会重复创建相同的边
            if ($startNode != $endNode && !Edge::where('start_node', $startNode)->where('end_node', $endNode)->exists()) {
                Edge::create([
                    'start_node' => $startNode,
                    'end_node' => $endNode,
                    'status' => 5, // 或者任何您想要的默认状态
                ]);
                $createdEdges++;
            }
        }
    }
}
//php artisan db:seed --class=EdgesTableSeeder