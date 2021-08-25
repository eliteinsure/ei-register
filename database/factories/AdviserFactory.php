<?php

namespace Database\Factories;

use App\Models\Adviser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class AdviserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adviser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => Arr::random(config('services.adviser.types')),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'fsp_no' => $this->faker->numerify('######'),
            'contact_number' => $this->faker->bothify('+639#########'),
            'status' => $this->faker->randomElement(['Active', 'Terminated']),
        ];
    }
}
