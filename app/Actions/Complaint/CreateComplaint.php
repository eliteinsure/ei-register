<?php

namespace App\Actions\Complaint;

use App\Models\Complaint;
use App\Traits\Validators\ComplaintValidator;
use Illuminate\Support\Facades\Validator;

class CreateComplaint
{
    use ComplaintValidator;

    public function create($input)
    {
        $data = Validator::make($input, $this->complaintRules(), [], $this->complaintAttributes())->validate();

        $data['tier'][1]['status'] = 'Pending';

        $complaint = Complaint::create($data);

        return $complaint;
    }
}
