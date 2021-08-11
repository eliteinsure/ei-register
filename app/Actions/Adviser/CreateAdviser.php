<?php

namespace App\Actions\Adviser;

use App\Models\Adviser;
use App\Traits\Validators\AdviserValidator;
use Illuminate\Support\Facades\Validator;

class CreateAdviser
{
    use AdviserValidator;

    public function create($input)
    {
        $data = Validator::make($input, $this->adviserRules(), [], $this->adviserAttributes())->validate();

        $data['status'] = 'Active';

        $adviser = Adviser::create($data);

        return $adviser;
    }
}
