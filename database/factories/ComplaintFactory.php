<?php

namespace Database\Factories;

use App\Models\Adviser;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'complainant' => $this->faker->name(),
            'label' => Arr::random(config('services.complaint.labels')),
            'received_at' => $this->faker->date(),
            'acknowledged_at' => $this->faker->date(),
            'nature' => Arr::random(config('services.complaint.natures')),
            'tier' => [
                'tier' => Arr::random(config('services.complaint.tier.tier')),
                'handler' => Arr::random(config('services.complaint.tier.handlers')),
                'status' => Arr::random(config('services.complaint.tier.status')),
                'stated_at' => $this->faker->date(),
            ],
        ];
    }

    public function tierFailed()
    {
        return $this->state(function (array $attributes) {
            $tier = $attributes['tier'];

            $tier['status'] = 'Failed';

            return [
                'tier' => $tier,
            ];
        });
    }

    public function configure()
    {
        return $this->afterMaking(function (Complaint $complaint) {
            if ('Client' == $complaint->label) {
                $complaint->policy_number = $this->faker->numerify('#####');
            }

            if (in_array($complaint->label, ['Client', 'Prospect'])) {
                $complaint->insurer = Arr::random(config('services.complaint.insurers'));
            }

            $tier = $complaint->tier;

            if ('Adviser' == $tier['handler']) {
                $tier['adviser_id'] = strval(Adviser::factory()->create(['status' => 'Active'])->id);
            }

            $complaint->tier = $tier;
        });
    }
}
