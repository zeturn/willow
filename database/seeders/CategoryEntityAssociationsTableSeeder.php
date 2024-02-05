<?php

namespace Database\Seeders;

// database/seeds/CategoryEntityAssociationsTableSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Entry; // 根据您的实际命名空间调整
use App\Models\Node; // 或Category，根据您的模型名称调整
use App\Models\CategoryEntityAssociation;

class CategoryEntityAssociationsTableSeeder extends Seeder
{
    public function run()
    {
        $entries = Entry::all();
        $nodes = Node::all(); // 或Category::all();

        // 确保有足够的Entry和Node（或Category）来创建链接
        if ($entries->count() < 1 || $nodes->count() < 1) {
            echo "需要更多的Entry和Node（或Category）数据。\n";
            return;
        }

        $linksToCreate = 100;
        for ($i = 0; $i < $linksToCreate; $i++) {
            $entry = $entries->random();
            $node = $nodes->random();

            // 使用提供的静态方法创建链接
            CategoryEntityAssociation::createCELink($entry, $node);
        }
    }
}
//php artisan db:seed --class=CategoryEntityAssociationsTableSeeder
