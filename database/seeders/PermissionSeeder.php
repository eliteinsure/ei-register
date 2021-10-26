<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('services.permissions') as $parentPermissionName => $parentPermission) {
            Permission::create([
                'name' => $parentPermissionName,
            ]);

            foreach ($parentPermission as $childPermissionName => $childPermission) {
                Permission::create([
                    'name' => $parentPermissionName . '.' . $childPermissionName,
                ]);
            }
        }

        $permissions = Permission::all()->pluck('name')->all();

        $user = User::oldest('id')->first();

        $user->syncPermissions($permissions);
    }
}
