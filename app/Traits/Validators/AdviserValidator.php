<?php

namespace App\Traits\Validators;

trait AdviserValidator
{
    public function adviserRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:advisers'],
            'fsp_no' => ['required', 'integer', 'max:999999999'],
            'contact_number' => ['required', 'string', 'max:255'],
        ];
    }

    public function adviserAttributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'fsp_no' => 'FSP Number',
            'contact_number' => 'Contact Number',
        ];
    }
}
