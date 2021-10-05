<?php

namespace App\Traits\Validators;

use Illuminate\Validation\Rule;

trait ComplaintValidator
{
    public function complaintRules($input)
    {
        return [
            'complainant' => ['required', 'string', 'max:255'],
            'label' => ['required', 'in:' . implode(',', config('services.complaint.labels'))],
            'complainee' => ['required', 'string', 'max:255'],
            'complainee_label' => ['required', 'in:' . implode(',', config('services.complaint.labels'))],
            'policy_number' => ['required_if:label,Client', 'string', 'max:255'],
            'insurer' => [
                Rule::requiredIf(function () use ($input) {
                    return in_array($input['label'] ?? '', ['Client', 'Prospect']);
                }),
                'in:' . implode(',', config('services.complaint.insurers')),
            ],
            'received_at' => ['required', 'date_format:Y-m-d'],
            'acknowledged_at' => ['required', 'date_format:Y-m-d'],
            'nature' => ['required', 'in:' . implode(',', config('services.complaint.natures'))],
            'tier' => ['required', 'array'],
            'tier.tier' => ['required', 'in:' . implode(',', config('services.complaint.tier.tier'))],
            'tier.handler' => ['required', 'in:' . implode(',', config('services.complaint.tier.handlers'))],
            'tier.adviser_id' => [
                'required',
                Rule::exists('advisers', 'id')->where(function ($query) use ($input) {
                    return $query->where('type', $input['tier']['handler'])
                        ->where('status', 'Active');
                }),
            ],
            'tier.status' => ['required', 'in:' . implode(',', config('services.complaint.tier.status'))],
            'tier.completed_at' => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    public function complaintAttributes($input)
    {
        return [
            'complainant' => 'Complainant Name',
            'label' => 'Label',
            'complainee' => 'Complainee Name',
            'complainee_label' => 'Label',
            'policy_number' => 'Policy Number',
            'insurer' => 'Insurer',
            'received_at' => 'Date Received',
            'registered_at' => 'Date Registered',
            'acknowledged_at' => 'Date Acknowledged',
            'nature' => 'Nature of Complaint',
            'tier' => 'Tier',
            'tier.tier' => 'Tier',
            'tier.handler' => 'Handled By',
            'tier.adviser_id' => $input['tier']['handler'],
            'tier.status' => 'Status',
            'tier.completed_at' => 'Date Completed',
        ];
    }
}
