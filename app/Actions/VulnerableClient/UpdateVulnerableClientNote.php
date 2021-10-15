<?php

namespace App\Actions\VulnerableClient;

use App\Models\VulnerableClientNote;
use App\Traits\Validators\VulnerableClientNoteValidator;
use Illuminate\Support\Facades\Validator;

class UpdateVulnerableClientNote
{
    use VulnerableClientNoteValidator;

    public function update($input, VulnerableClientNote $note)
    {
        $data = Validator::make($input, $this->vulnerableClientNoteRules(true), [], $this->vulnerableClientNoteAttributes())->validate();

        if (isset($data['created_time'])) {
            $data['created_at'] .= ' ' . $data['created_time'];

            unset($data['created_time']);
        }

        $data['created_by'] = auth()->user()->id;

        $note->update($data);
    }
}
