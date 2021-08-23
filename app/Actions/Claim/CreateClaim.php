<?php

namespace App\Actions\Claim;

use App\Models\Claim;
use App\Traits\Validators\ClaimValidator;
use Illuminate\Support\Facades\Validator;

class CreateClaim
{
    use ClaimValidator;

    public function create($input)
    {
        $data = Validator::make($input, $this->claimRules(), [], $this->claimAttributes())->validate();

        $claim = Claim::create($data);

        return $claim;
    }
}
