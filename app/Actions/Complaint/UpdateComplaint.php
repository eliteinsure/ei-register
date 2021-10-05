<?php

namespace App\Actions\Complaint;

use App\Models\Complaint;
use App\Traits\Validators\ComplaintValidator;
use Illuminate\Support\Facades\Validator;

class UpdateComplaint
{
    use ComplaintValidator;

    public function update($input, Complaint $complaint)
    {
        $data = Validator::make($input, $this->complaintRules($input), [], $this->complaintAttributes($input))->validate();

        $complaint->update($data);

        return $complaint;
    }
}
