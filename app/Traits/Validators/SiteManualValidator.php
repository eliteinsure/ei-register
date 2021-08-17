<?php

namespace App\Traits\Validators;

use App\Models\Site;
use Illuminate\Validation\Rule;

trait SiteManualValidator
{
    public function siteManualRules(Site $site)
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('site_manuals')->where(function ($query) use ($site) {
                    return $query->where('site_id', $site->id);
                }),
            ],
            'file' => [
                'required',
                'file',
                'mimes:' . implode(',', config('services.site.manual.mimes')),
                'mimetypes:' . implode(',', config('services.site.manual.mimetypes')),
            ],
        ];
    }

    public function siteManualAttributes()
    {
        return [
            'name' => 'Name',
            'file' => 'File',
        ];
    }
}
