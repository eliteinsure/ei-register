<?php

namespace Database\Factories;

use App\Models\VulnerableClient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class VulnerableClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VulnerableClient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'insurer' => Arr::random(config('services.complaint.insurers')),
            'policy_number' => $this->faker->numerify('#####'),
            'issued_at' => $this->faker->date(),
            'nature' => Arr::random(config('services.vulnerableClients.natures')),
        ];
    }
}
