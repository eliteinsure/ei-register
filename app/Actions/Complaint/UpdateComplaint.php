<?php

namespace App\Actions\Complaint;

use App\Models\Complaint;
use App\Traits\Validators\ComplaintsValidator;
use Illuminate\Support\Facades\Validator;

class UpdateComplaint
{
    use ComplaintsValidator;

    public function update($input, Complaint $complaint)
    {
        $data = Validator::make($input, $this->complaintRules(), [], $this->complaintAttributes())->validate();

        if ('Failed' != $data['tier'][1]['result']) {
            unset($data['tier'][2]);
        }

        $complaint->update($data);

        return $complaint;
    }
}
