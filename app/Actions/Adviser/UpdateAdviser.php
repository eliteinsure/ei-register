<?php

namespace App\Actions\Adviser;

use App\Models\Adviser;
use App\Traits\Validators\AdviserValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateAdviser
{
    use AdviserValidator;

    public function update($input, Adviser $adviser)
    {
        $rules = $this->adviserRules();

        $attributes = $this->adviserAttributes();

        $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('advisers')->ignore($adviser)];

        $rules['status'] = ['required', 'in:' . implode(',', config('services.adviser.status'))];

        $attributes['status'] = 'Status';

        $data = Validator::make($input, $rules, [], $attributes)->validate();

        $adviser->update($data);

        return $adviser;
    }
}
