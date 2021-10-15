<?php

namespace App\Traits\Validators;

trait VulnerableClientNoteValidator
{
    public function vulnerableClientNoteRules($update = false)
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

    public function vulnerableclientNoteAttributes()
    {
        return [
            'notes' => 'Notes',
            'created_at' => 'Date Added',
            'created_time' => 'Time Added',
        ];
    }
}
