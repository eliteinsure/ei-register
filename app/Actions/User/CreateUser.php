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

        $role = $data['role'];

        unset($data['role']);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $user->assignRole($role);

        return $user;
    }
}
