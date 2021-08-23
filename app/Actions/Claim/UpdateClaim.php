<?php

namespace App\Actions\Claim;

use App\Models\Claim;
use App\Traits\Validators\ClaimValidator;
use Illuminate\Support\Facades\Validator;

class UpdateClaim
{
    use ClaimValidator;

    public function update($input, Claim $claim)
    {
        $data = Validator::make($input, $this->claimRules(), [], $this->claimAttributes())->validate();

        $claim->update($data);
    }
}
