<?php

namespace App\Traits\Validators;

trait ComplaintNoteValidator
{
    public function complaintNoteRules($update = false)
    {
        $rules = [
            'notes' => ['required', 'string'],
        ];

        if ($update) {
            $rules['created_at'] = ['required', 'date_format:Y-m-d'];
            $rules['created_time'] = ['nullable', 'date_format:H:i'];
        }

        return $rules;
    }

    public function complaintNoteAttributes()
    {
        return [
            'notes' => 'Notes',
            'created_at' => 'Date Added',
            'created_time' => 'Time Added'
        ];
    }
}
