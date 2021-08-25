<?php

namespace App\Traits\Validators;

use Illuminate\Validation\Rule;

trait ComplaintValidator
{
    public function complaintRules($update = false)
    {
        $rules = [
            'complainant' => ['required', 'string', 'max:255'],
            'label' => ['required', 'in:' . implode(',', config('services.complaint.labels'))],
            'policy_number' => ['required_if:label,Client', 'string', 'max:255'],
            'insurer' => ['required', 'in:' . implode(',', config('services.complaint.insurers'))],
            'received_at' => ['required', 'date_format:Y-m-d'],
            'acknowledged_at' => ['required', 'date_format:Y-m-d'],
            'nature' => ['required', 'in:' . implode(',', config('services.complaint.natures'))],
            'tier.1' => ['required', 'array'],
            'tier.1.adviser_id' => [
                'required',
                Rule::exists('advisers', 'id')->where(function ($query) {
                    return $query->where('status', 'Active');
                }),
            ],
            'tier.1.handed_over_at' => ['required', 'date_format:Y-m-d'],
            'tier.1.notes' => ['nullable', 'string'],
        ];

        if ($update) {
            $rules = array_merge($rules, [
                'tier.1.status' => ['required', 'in:' . implode(',', config('services.complaint.tier.1.status'))],
                'tier.1.stated_at' => ['required', 'date_format:Y-m-d'],
                'tier.2' => ['required_if:tier.1.status,Failed', 'array'],
                'tier.2.staff_position' => ['required_if:tier.1.status,Failed', 'string', 'max:255'],
                'tier.2.staff_id' => [
                    'required_if:tier.1.status,Failed',
                    Rule::exists('advisers', 'id')->where(function ($query) {
                        return $query->where('status', 'Active');
                    }),
                ],
                'tier.2.handed_over_at' => ['required_if:tier.1.status,Failed', 'date_format:Y-m-d'],
                'tier.2.status' => ['required_if:tier.1.status,Failed', 'in:' . implode(',', config('services.complaint.tier.2.status'))],
                'tier.2.notes' => ['nullable', 'string'],
            ]);
        }

        return $rules;
    }

    public function complaintAttributes()
    {
        return [
            'complainant' => 'Complainant Name',
            'label' => 'Label',
            'policy_number' => 'Policy Number',
            'insurer' => 'Insurer',
            'received_at' => 'Date Received',
            'registered_at' => 'Date Registered',
            'acknowledged_at' => 'Date Acknowledged',
            'nature' => 'Nature of Complaint',
            'tier' => 'Tier',
            'tier.1' => 'Tier 1',
            'tier.1.adviser_id' => 'Adviser',
            'tier.1.handed_over_at' => 'Date Handed Over',
            'tier.1.status' => 'Status',
            'tier.1.stated_at' => 'Date Stated',
            'tier.1.notes' => 'Notes',
            'tier.2' => 'Tier 2',
            'tier.2.staff_position' => 'Management / Staff',
            'tier.2.staff_name' => 'Staff Name',
            'tier.2.handed_over_at' => 'Date Handed Over',
            'tier.2.status' => 'Status',
            'tier.2.notes' => 'Notes',
        ];
    }
}
