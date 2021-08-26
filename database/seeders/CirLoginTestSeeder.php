<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CirLoginTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first();

        $user->createToken('cir');

        $token = $user->tokens()->first();

        $query = DB::table('personal_access_tokens')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'personal_access_tokens.tokenable_id')
                    ->where('tokenable_type', 'App\\Models\\User');
            })->leftJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', 'App\\Models\\User');
            })->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('personal_access_tokens.token', $token->token)
            ->select('users.id', 'users.name', 'users.email', 'roles.name as role');

        $query->dump();

        $cirUser = $query->first();

        dump($cirUser);
    }
}
