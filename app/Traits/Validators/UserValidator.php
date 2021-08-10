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
            'role' => ['required', 'in:' . implode(',', config('services.roles'))],
        ];
    }

    public function userAttributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }
}
