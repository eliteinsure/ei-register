<?php

namespace App\Actions\Adviser;

use App\Models\Adviser;
use App\Traits\Validators\AdviserRequirementValidator;
use Illuminate\Support\Facades\Validator;

class UpdateAdviserRequirement
{
    use AdviserRequirementValidator;

    public function update($input, Adviser $adviser)
    {
        $data = Validator::make($input, $this->adviserRequirementRules(), [], $this->adviserRequirementAttributes())->validate();

        $adviser->update([
            'requirements' => $data,
        ]);

        return $adviser;
    }
}
