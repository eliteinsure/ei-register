<?php

namespace Database\Factories;

use App\Models\Claim;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ClaimFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Claim::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_name' => $this->faker->name(),
            'insurer' => Arr::random(config('services.complaint.insurers')),
            'policy_number' => $this->faker->numerify('#####'),
            'nature' => Arr::random(config('services.claim.natures')),
            'type' => $this->faker->randomElements(config('services.claim.types'), $this->faker->numberBetween(1, count(config('services.claim.types')))),
            'status' => Arr::random(config('services.claim.status')),
        ];
    }
}
