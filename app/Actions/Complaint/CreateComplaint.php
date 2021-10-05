<?php

namespace App\Actions\Complaint;

use App\Models\Complaint;
use App\Traits\Validators\ComplaintNoteValidator;
use App\Traits\Validators\ComplaintValidator;
use Illuminate\Support\Facades\Validator;

class CreateComplaint
{
    use ComplaintValidator;
    use ComplaintNoteValidator;

    public function create($input, $notesInput)
    {
        $data = Validator::make($input, $this->complaintRules($input), [], $this->complaintAttributes($input))->validate();

        $complaintNoteRules = $this->complaintNoteRules();

        $complaintNoteRules['notes'] = ['nullable', 'string'];

        $notesData = Validator::make($notesInput, $complaintNoteRules, [], $this->complaintNoteAttributes())->validate();

        $complaint = Complaint::create($data);

        if (isset($notesData['notes'])) {
            $notesData['created_by'] = auth()->user()->id;

            $complaint->notes()->create($notesData);
        }

        return $complaint;
    }
}
