<?php

namespace App\Actions\VulnerableClient;

use App\Traits\Validators\VulnerableClientReportValidator;
use Illuminate\Support\Facades\Validator;

class GenerateVulnerableClientReport
{
    use VulnerableClientReportValidator;

    public function generate($input)
    {
        $data = Validator::make($input, $this->vulnerableClientReportRules(), [], $this->vulnerableClientReportAttributes())->validate();

        $data['now'] = time();

        return route('reports.vulnerable-clients.index', $data);
    }
}
