<?php

namespace App\Traits\Validators;

use App\Actions\Fortify\PasswordValidationRules;

trait UserValidator
{
    use PasswordValidationRules;

    public function userRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ];
    }

    public function userAttributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'permissions' => 'Permissions',
            'permissions.*' => 'Permission',
        ];
    }
}
