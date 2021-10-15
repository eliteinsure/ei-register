<?php

namespace App\Traits\Validators;

trait VulnerableClientValidator
{
    public function vulnerableClientRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'insurer' => ['required', 'in:' . implode(',', config('services.complaint.insurers'))],
            'policy_number' => ['required', 'string', 'max:255'],
            'issued_at' => ['required', 'date_format:Y-m-d'],
            'nature' => ['required', 'in:' . implode(',', config('services.vulnerableClients.natures'))],
        ];
    }

    public function vulnerableClientAttributes()
    {
        return [
            'name' => 'Name',
            'insurer' => 'Insurer',
            'policy_number' => 'Policy Number',
            'issued_at' => 'Date Issued',
            'nature' => 'Nature',
        ];
    }
}
