<?php

namespace App\Traits\Validators;

trait ComplaintNoteValidator
{
    public function complaintNoteRules()
    {
        return [
            'notes' => ['required', 'string'],
        ];
    }

    public function complaintNoteAttributes()
    {
        return [
            'notes' => 'Notes',
        ];
    }
}
