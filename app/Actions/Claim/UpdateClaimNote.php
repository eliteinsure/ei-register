<?php

namespace App\Actions\Claim;

use App\Models\ClaimNote;
use App\Traits\Validators\ClaimNoteValidator;
use Illuminate\Support\Facades\Validator;

class UpdateClaimNote
{
    use ClaimNoteValidator;

    public function update($input, ClaimNote $note)
    {
        $data = Validator::make($input, $this->claimNoteRules(true), [], $this->claimNoteAttributes())->validate();

        if (isset($data['created_time'])) {
            $data['created_at'] .= ' ' . $data['created_time'];

            unset($data['created_time']);
        }

        $data['created_by'] = auth()->user()->id;

        $note->update($data);
    }
}
