<?php

namespace App\Traits\Validators;

trait ClaimValidator
{
    public function claimRules()
    {
        return [
            'client_name' => ['required', 'string', 'max:255'],
            'insurer' => ['required', 'in:' . implode(',', config('services.complaint.insurers'))],
            'policy_number' => ['required', 'string', 'max:255'],
            'nature' => ['required', 'in:' . implode(',', config('services.claim.natures'))],
            'type' => ['required', 'array'],
            'type.*' => ['required', 'in:' . implode(',', config('services.claim.types'))],
            'status' => ['required', 'in:' . implode(',', config('services.claim.status'))],
        ];
    }

    public function claimAttributes()
    {
        return [
            'client_name' => 'Client Name',
            'insurer' => 'Insurer',
            'policy_number' => 'Policy Number',
            'nature' => 'Nature',
            'type' => 'Type',
            'type.*' => 'Type',
            'status' => 'Status',
        ];
    }
}
