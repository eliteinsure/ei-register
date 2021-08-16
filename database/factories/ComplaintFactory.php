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
            'policy_number' => $this->faker->numerify('#####'),
            'insurer' => Arr::random(config('services.complaint.insurers')),
            'received_at' => $this->faker->date(),
            'acknowledged_at' => $this->faker->date(),
            'nature' => Arr::random(config('services.complaint.natures')),
            'tier' => [
                '1' => [
                    'adviser_id' => Adviser::factory(),
                    'handed_over_at' => $this->faker->date(),
                    'status' => Arr::random(config('services.complaint.tier.1.status')),
                    'stated_at' => $this->faker->date(),
                    'notes' => $this->faker->sentence,
                ],
            ],
        ];
    }

    public function tier1Failed()
    {
        return $this->state(function (array $attributes) {
            $tier = $attributes['tier'];

            $tier['1']['status'] = 'Failed';

            return [
                'tier' => $tier,
            ];
        });
    }

    public function configure()
    {
        return $this->afterMaking(function (Complaint $complaint) {
            if ('Failed' != $complaint->tier['1']['status']) {
                return;
            }

            $tier = $complaint->tier;

            $tier['2'] = [
                'staff_position' => Arr::random(config('services.complaint.tier.2.staffPositions')),
                'staff_name' => $this->faker->name(),
                'handed_over_at' => $this->faker->date(),
                'status' => Arr::random(config('services.complaint.tier.2.status')),
                'notes' => $this->faker->sentence,
            ];

            $complaint->tier = $tier;
        });
    }
}
