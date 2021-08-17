<?php

namespace Database\Factories;

use App\Models\Site;
use App\Models\SiteManual;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SiteManualFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SiteManual::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_id' => Site::factory(),
            'name' => $this->faker->catchPhrase,
            'disk' => 'public',
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (SiteManual $manual) {
            $manual->file = UploadedFile::fake()->create('site-manual.pdf', 128);
        })->afterCreating(function (SiteManual $manual) {
            $manual->update([
                'file' => Storage::disk('public')->putFile('site-manuals', $manual->path),
            ]);
        });
    }
}
