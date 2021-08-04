<?php

namespace App\Actions\Complaint;

use App\Models\Complaint;
use App\Traits\Validators\ComplaintsValidator;
use Illuminate\Support\Facades\Validator;

class CreateComplaint
{
    use ComplaintsValidator;

    public function create($input)
    {
        $data = Validator::make($input, $this->complaintRules(), [], $this->complaintAttributes())->validate();

        if ('Failed' != $data['tier'][1]['result']) {
            unset($data['tier'][2]);
        }

        $complaint = Complaint::create($data);

        return $complaint;
    }
}
