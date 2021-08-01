<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::factory()->create([
            'email' => 'admin@mail.com',
            'name' => 'Administrator',
        ]);

        $complainants = [];

        $advisers = [];

        foreach (range(1, 10) as $item) {
            array_push($complainants, $faker->name());
            array_push($advisers, $faker->name());
        }

        foreach (range(1, 100) as $item) {
            $data = Complaint::factory()->make([
                'complainant' => $faker->randomElement($complainants),
            ])->toArray();

            $data['tier'][1]['adviser'] = $faker->randomElement($advisers);

            Complaint::create($data);
        }
    }
}
