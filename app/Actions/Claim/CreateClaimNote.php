<?php

namespace App\Actions\Claim;

use App\Models\Claim;
use App\Traits\Validators\ClaimNoteValidator;
use Illuminate\Support\Facades\Validator;

class CreateClaimNote
{
    use ClaimNoteValidator;

    public function create($input, Claim $claim)
    {
        $data = Validator::make($input, $this->claimNoteRules(), [], $this->claimNoteAttributes())->validate();

        $data['created_by'] = auth()->user()->id;

        $note = $claim->notes()->create($data);

        return $note;
    }
}
