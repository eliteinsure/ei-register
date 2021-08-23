<?php

namespace App\Actions\Claim;

use App\Traits\Validators\ClaimReportValidator;
use Illuminate\Support\Facades\Validator;

class GenerateClaimReport
{
    use ClaimReportValidator;

    public function generate($input)
    {
        $data = Validator::make($input, $this->claimReportRules(), [], $this->claimReportAttributes())->validate();

        $data['now'] = time();

        return route('reports.claims.index', $data);
    }
}
