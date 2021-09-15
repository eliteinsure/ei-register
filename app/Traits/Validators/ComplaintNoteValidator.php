<?php

namespace App\Traits\Validators;

trait ComplaintNoteValidator
{
    public function complaintNoteRules()
    {
        return [
            'notes' => ['required', 'string'],
            'tier' => ['required', 'in:1,2'],
        ];
    }

    public function complaintNoteAttributes()
    {
        return [
            'notes' => 'Notes',
            'tier' => 'Tier',
        ];
    }
}
