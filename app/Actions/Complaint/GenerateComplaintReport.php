<?php

namespace App\Actions\Complaint;

use App\Traits\Validators\ComplaintReportValidator;
use Illuminate\Support\Facades\Validator;

class GenerateComplaintReport
{
    use ComplaintReportValidator;

    public function generate($input)
    {
        $data = Validator::make($input, $this->complaintReportRules(), [], $this->complaintReportAttributes())->validate();

        return route('reports.complaints.index', $data);
    }
}
