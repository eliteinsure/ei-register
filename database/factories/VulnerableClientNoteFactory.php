<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\VulnerableClient;
use App\Models\VulnerableClientNote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VulnerableClientNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VulnerableClientNote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vulnerable_client_id' => VulnerableClient::inRandomOrder()->firstOrCreate(VulnerableClient::factory()->make()->toArray())->id,
            'created_by' => User::inRandomOrder()->first()->id,
            'notes' => $this->faker->paragraph,
        ];
    }
}
