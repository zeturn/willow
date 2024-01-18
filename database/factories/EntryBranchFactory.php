<?php

// 20231112 不要用，没写好
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Entry;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntryryBranch>
 */
class EntryBranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entry_id' => Entry::inRandomOrder()->first()->id ?? Entry::factory()->create()->id, // 自动生成 Entry

            'is_pb' => $this->faker->boolean,
            'is_free' => $this->faker->boolean,
            'status' => $this->faker->randomElement([0, 1])
        ];
    }
}
