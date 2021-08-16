<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Site::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->safeEmailDomain,
            'launch_date' => $this->faker->date(),
            'update_date' => $this->faker->date(),
            'description' => $this->faker->sentence,
        ];
    }
}
