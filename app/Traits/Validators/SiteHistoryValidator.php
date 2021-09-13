<?php

namespace App\Traits\Validators;

trait SiteHistoryValidator
{
    public function siteHistoryRules()
    {
        return [
            'updates' => ['required', 'string'],
            'update_date' => ['required', 'date_format:Y-m-d'],
            'developer' => ['required', 'string', 'max:255'],
            'version' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function siteHistoryAttributes()
    {
        return [
            'updates' => 'Updates',
            'update_date' => 'Date Updated',
            'developer' => 'Developer',
            'version' => 'Version',
        ];
    }
}
