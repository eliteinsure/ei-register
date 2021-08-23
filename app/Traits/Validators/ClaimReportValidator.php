<?php

namespace App\Traits\Validators;

trait ClaimReportValidator
{
    public function claimReportRules()
    {
        return [
            'created_from' => ['required', 'date_format:Y-m-d'],
            'created_to' => ['required', 'date_format:Y-m-d'],
        ];
    }

    public function claimReportAttributes()
    {
        return [
            'created_from' => 'Registered From',
            'created_to' => 'Registered To',
        ];
    }
}
