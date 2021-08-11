<?php

namespace App\Traits\Validators;

trait AdviserValidator
{
    public function adviserRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:advisers'],
            'fsp_no' => ['required', 'integer', 'max:999999999'],
            'contact_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'fap_name' => ['required', 'string', 'max:255'],
            'fap_email' => ['required', 'string', 'email'],
            'fap_fsp_no' => ['required', 'integer', 'max:999999999'],
            'fap_contact_number' => ['required', 'string', 'max:255'],
        ];
    }

    public function adviserAttributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'fsp_no' => 'FSP Number',
            'contact_number' => 'Contact Number',
            'address' => 'Address',
            'fap_name ' => 'FAP Name',
            'fap_email' => 'FAP Email',
            'fap_fsp_no' => 'FAP FSP Number',
            'fap_contact_number' => 'FAP Contact Number',
        ];
    }
}
