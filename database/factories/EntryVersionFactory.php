<?php
// 20231112 不要用，没写好
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EntryVersion;
use App\Models\EntryBranch;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntryVersion>
 */
class EntryVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entry_branch_id' => EntryBranch::inRandomOrder()->first()->id ?? EntryBranch::factory()->create()->id, // 或者使用已存在的 Branch ID
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'author_id' => User::inRandomOrder()->first()->uuid ?? User::factory()->create()->id, // 或者使用已存在的 User ID
            'status' => $this->faker->randomElement([0, 1])
        ];
    }
}
