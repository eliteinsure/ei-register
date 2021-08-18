<?php

namespace App\Actions\Site;

use App\Traits\Validators\SiteReportValidator;
use Illuminate\Support\Facades\Validator;

class GenerateSiteReport
{
    use SiteReportValidator;

    public function generate($input)
    {
        $data = Validator::make($input, $this->siteReportRules(), [], $this->siteReportAttributes())->validate();

        return route('reports.sites.index', $data);
    }
}
