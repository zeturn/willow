<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryVersion;
use App\Models\EntryBranchUser;
use App\Models\User;
use Faker\Factory as Faker;


class EntrySeeder extends Seeder
{
    public function run()
    {

        $faker = Faker::create();

        // 创建 50 个 Entry
        for ($i = 0; $i < 50; $i++) {
            $entry = Entry::create([
                'name' => 'Entry Name ' . $i,
                'status' => 1101111545,
                // 其他所需字段...
            ]);

            $branches = collect();

            // 对每个 Entry 创建 10 个 EntryBranch
            for ($j = 0; $j < 10; $j++) {
                $branch = EntryBranch::create([
                    'entry_id' => $entry->id,
                    'name' => $faker->slug,
                    'is_pb' => rand(0, 1),
                    'is_free' => rand(0, 1),
                    'status' => 1201111545,
                    // 其他所需字段...
                ]);

                $versions = collect();

                // 对每个 EntryBranch 创建 10 个 EntryVersion
                for ($k = 0; $k < 10; $k++) {
                    $version = EntryVersion::create([
                        'entry_branch_id' => $branch->id,
                        'name' => '(Version ' . $k . ')'. $faker->text,
                        'description' => $faker->text,
                        'content' => $faker->sentence,
                        'author_id' => User::inRandomOrder()->first()->id,
                        'status' => 1301111545,
                        // 其他所需字段...
                    ]);

                    $versions->push($version);
                }

                // 随机选择一个 Version 作为 EntryBranch 的 demo_version_id
                $branch->update(['demo_version_id' => $versions->random()->id]);

                $branches->push($branch);
            }

            // 随机选择一个 Branch 作为 Entry 的 demo_branch_id
            $entry->update(['demo_branch_id' => $branches->random()->id]);

            // 对每个 Branch 关联 5 个用户
            foreach ($branches as $branch) {
                $users = User::inRandomOrder()->take(5)->get();
                $first = true;

                foreach ($users as $user) {
                    EntryBranchUser::create([
                        'entry_branch_id' => $branch->id,
                        'user_id' => $user->id,
                        'role' => $first ? 1 : 2, // 第一个用户为拥有者 (role = 1)
                    ]);

                    $first = false;
                }
            }
        }
    }
}
// php artisan db:seed --class=EntrySeeder