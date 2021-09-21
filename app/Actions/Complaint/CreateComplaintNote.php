<?php

namespace App\Actions\Complaint;

use App\Models\Complaint;
use App\Traits\Validators\ComplaintNoteValidator;
use Illuminate\Support\Facades\Validator;

class CreateComplaintNote
{
    use ComplaintNoteValidator;

    public function create($input, Complaint $complaint)
    {
        $data = Validator::make($input, $this->complaintNoteRules(), [], $this->complaintNoteAttributes())->validate();

        $data['created_by'] = auth()->user()->id;

        $note = $complaint->notes()->create($data);

        return $note;
    }
}
