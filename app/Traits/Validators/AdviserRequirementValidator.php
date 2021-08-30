<?php

namespace App\Traits\Validators;

use Illuminate\Support\Str;

trait AdviserRequirementValidator
{
    public function adviserRequirementRules()
    {
        $rules = [];

        foreach (config('services.adviser.requirements') as $requirementKey => $requirement) {
            $rules[$requirementKey] = ['nullable', 'array'];
            $rules[$requirementKey . '.*'] = ['nullable', 'in:' . implode(',', array_keys($requirement))];

            foreach ($requirement as $subRequirementKey => $subRequirement) {
                $rules[$requirementKey . '.' . $subRequirementKey] = ['nullable', $this->getRuleByOption($subRequirement)];
            }
        }

        return $rules;
    }

    public function adviserRequirementAttributes()
    {
        $attributes = [];

        foreach (config('services.adviser.requirements') as $requirementKey => $requirement) {
            $attributes[$requirementKey] = Str::title(Str::replace('_', ' ', $requirementKey));
            $attributes[$requirementKey . '.*'] = Str::title(Str::replace('_', ' ', $requirementKey));

            foreach ($requirement as $subRequirementKey => $subRequirement) {
                $attributes[$requirementKey . '.' . $subRequirementKey] = $subRequirement['label'];
            }
        }

        return $attributes;
    }

    public function getRuleByOption($requirement)
    {
        $options = $requirement['options'];

        if (is_array($options)) {
            return 'in:' . implode(',', $options);
        }

        if ('expiring-date' == $options) {
            return 'date_format:Y-m-d';
        }

        return 'string';
    }
}
