<?php

namespace Database\Seeders;

use App\Models\Adviser;
use App\Models\Claim;
use App\Models\Complaint;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $this->call([RoleSeeder::class, UserSeeder::class]);

        $complainants = [];

        Adviser::factory(10)->create([
            'status' => 'Active',
        ]);

        $staffNames = [];

        foreach (range(1, 10) as $item) {
            array_push($complainants, $faker->name());
        }

        foreach (range(1, 100) as $item) {
            $data = Complaint::factory()->make([
                'complainant' => $faker->randomElement($complainants),
            ])->toArray();

            $data['tier'][1]['adviser_id'] = strval(Adviser::inRandomOrder()->first()->id);

            if (isset($data['tier'][2]['staff_id'])) {
                $data['tier'][2]['staff_id'] = strval(Adviser::inRandomOrder()->first()->id);
            }

            Complaint::create($data);

            Claim::factory()->create([
                'adviser_id' => Adviser::where('type', 'Adviser')->inRandomOrder()->first()->id,
            ]);
        }

        $user = User::factory()->create();

        $user->assignRole('admin');
    }
}
