<?php

namespace App\Traits\Validators;

trait SiteReportValidator
{
    public function siteReportRules()
    {
        return [
            'launch_from' => ['required_with:launch_to', 'date_format:Y-m-d'],
            'launch_to' => ['required_with:launch_from', 'date_format:Y-m-d'],
            'update_from' => ['required_with:update_to', 'date_format:Y-m-d'],
            'update_to' => ['required_with:update_from', 'date_format:Y-m-d'],
        ];
    }

    public function siteReportAttributes()
    {
        return [
            'launch_from' => 'Date Launced From',
            'launch_to' => 'Date Launched To',
            'update_from' => 'Date Last Updated From',
            'update_to' => 'Date Last Updated To',
        ];
    }
}
