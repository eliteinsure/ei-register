<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'email' => 'admin@mail.com',
            'name' => 'Administrator',
        ]);

        $admin->assignRole('admin');

        $user = User::factory()->create([
            'email' => 'user@mail.com',
            'name' => 'User',
        ]);

        $user->assignRole('user');
    }
}
