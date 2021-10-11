<?php

namespace Database\Factories;

use App\Models\Claim;
use App\Models\ClaimNote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClaimNote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'claim_id' => Claim::inRandomOrder()->firstOrCreate(Claim::factory()->make()->toArray())->id,
            'created_by' => User::inRandomOrder()->first()->id,
            'notes' => $this->faker->paragraph,
        ];
    }
}
