<?php

namespace App\Traits\Validators;

trait VulnerableClientReportValidator
{
    public function vulnerableClientReportRules()
    {
        return [
            'issued_from' => ['required', 'date_format:Y-m-d'],
            'issued_to' => ['required', 'date_format:Y-m-d'],
        ];
    }

    public function vulnerableClientReportAttributes()
    {
        return [
            'issued_from' => 'Issued From',
            'issued_to' => 'Issued To',
        ];
    }
}
