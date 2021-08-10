<?php

namespace App\Traits\Validators;

trait ComplaintValidator
{
    public function complaintRules()
    {
        return [
            'complainant' => ['required', 'string', 'max:255'],
            'label' => ['required', 'in:' . implode(',', config('services.complaint.labels'))],
            'policy_number' => ['required', 'string', 'max:255'],
            'insurer' => ['required', 'in:' . implode(',', config('services.complaint.insurers'))],
            'received_at' => ['required', 'date_format:Y-m-d'],
            'registered_at' => ['required', 'date_format:Y-m-d'],
            'acknowledged_at' => ['required', 'date_format:Y-m-d'],
            'nature' => ['required', 'in:' . implode(',', config('services.complaint.natures'))],
            'tier' => ['required', 'array'],
            'tier.1' => ['required', 'array'],
            'tier.1.adviser' => ['required', 'string', 'max:255'],
            'tier.1.handed_over_at' => ['required', 'date_format:Y-m-d'],
            'tier.1.result' => ['required', 'in:' . implode(',', config('services.complaint.tier.1.results'))],
            'tier.1.resulted_at' => ['required', 'date_format:Y-m-d'],
            'tier.2' => ['required_if:tier.1.result,Failed', 'array'],
            'tier.2.staff_position' => ['required_if:tier.1.result,Failed', 'string', 'max:255'],
            'tier.2.staff_name' => ['required_if:tier.1.result,Failed', 'string', 'max:255'],
            'tier.2.handed_over_at' => ['required_if:tier.1.result,Failed', 'date_format:Y-m-d'],
            'tier.2.result' => ['required_if:tier.1.result,Failed', 'in:' . implode(',', config('services.complaint.tier.2.results'))],
            'notes' => ['nullable', 'string'],
        ];
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
            'tier.1.adviser' => 'Adviser',
            'tier.1.handed_over_at' => 'Date Handed Over',
            'tier.1.result' => 'Result',
            'tier.1.resulted_at' => 'Results Date',
            'tier.2' => 'Tier 2',
            'tier.2.staff_position' => 'Staff',
            'tier.2.staff_name' => 'Staff Name',
            'tier.2.handed_over_at' => 'Date Handed Over',
            'tier.2.result' => 'Result',
            'notes' => 'Notes',
        ];
    }
}
