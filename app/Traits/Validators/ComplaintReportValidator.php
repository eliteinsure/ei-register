<?php

namespace App\Traits\Validators;

trait ComplaintReportValidator
{
    public function complaintReportRules()
    {
        return [
            'received_from' => ['required', 'date_format:Y-m-d'],
            'received_to' => ['required', 'date_format:Y-m-d'],
            'advisers' => ['nullable', 'array'],
            'advisers.*' => ['nullable', 'exists:advisers,id'],
        ];
    }

    public function complaintReportAttributes()
    {
        return [
            'received_from' => 'Date Received From',
            'received_to' => 'Date Received To',
            'advisers' => 'Advisers',
        ];
    }
}
