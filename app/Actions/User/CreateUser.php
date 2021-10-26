<?php

namespace App\Actions\User;

use App\Models\User;
use App\Traits\Validators\UserValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser
{
    use UserValidator;

    public function create($input)
    {
        $data = Validator::make($input, $this->userRules(), [], $this->userAttributes())->validate();

        $permissions = $data['permissions'];

        unset($data['permissions']);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $user->syncPermissions($permissions);

        return $user;
    }
}
