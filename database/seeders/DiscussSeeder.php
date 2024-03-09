<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wall;
use App\Models\Topic;
use App\Models\Comment;
use App\Models\User;
use Faker\Factory as Faker;

class DiscussSeeder extends Seeder
{
    public function run()
    {

        // 开始计时
        $start = microtime(true);

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $wall = Wall::create([
                'name' => $faker->word,
                'slug' => $faker->slug,
                'description' => $faker->sentence,
                'status' => 5
            ]);

            for ($j = 0; $j < 30; $j++) {
                $topic = Topic::create([
                    'wall_id' => $wall->id,
                    'name' => $faker->word,
                    'slug' => $faker->slug,
                    'description' => $faker->sentence,
                    'status' => 5
                ]);

                for ($k = 0; $k < 30; $k++) {
                    Comment::create([
                        'topic_id' => $topic->id,
                        'user_id' => User::inRandomOrder()->first()->id,
                        'content' => $faker->text,
                        'status' => 5
                    ]);
                }
            }
        }

        // 结束计时
        $end = microtime(true);
        // 计算所需时间（毫秒）
        $executionTime = round(($end - $start) * 1000, 2);

        // 输出所需时间到终端
        echo 'Discuss在 ' . $executionTime . ' ms 内完成填充' . PHP_EOL;
    }
}

