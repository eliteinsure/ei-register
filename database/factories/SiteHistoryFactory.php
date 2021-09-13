<?php

namespace Database\Factories;

use App\Models\Site;
use App\Models\SiteHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SiteHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_id' => Site::inRandomOrder()->firstOrCreate(Site::factory()->make()->toArray())->id,
            'updates' => $this->faker->paragraph,
            'update_date' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'developer' => $this->faker->name,
            'version' => $this->faker->numberBetween(0, 5),
        ];
    }
}
