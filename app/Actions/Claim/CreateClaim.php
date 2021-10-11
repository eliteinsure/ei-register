<?php

namespace App\Actions\Claim;

use App\Models\Claim;
use App\Traits\Validators\ClaimNoteValidator;
use App\Traits\Validators\ClaimValidator;
use Illuminate\Support\Facades\Validator;

class CreateClaim
{
    use ClaimValidator;
    use ClaimNoteValidator;

    public function create($input, $notesInput)
    {
        $data = Validator::make($input, $this->claimRules(), [], $this->claimAttributes())->validate();

        $claimNoteRules = $this->claimNoteRules();

        $claimNoteRules['notes'] = ['nullable', 'string'];

        $notesData = Validator::make($notesInput, $claimNoteRules, [], $this->claimNoteAttributes())->validate();

        $claim = Claim::create($data);

        if (isset($notesData['notes'])) {
            $notesData['created_by'] = auth()->user()->id;

            $claim->notes()->create($notesData);
        }

        return $claim;
    }
}
