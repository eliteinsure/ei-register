<?php

namespace App\Actions\Site;

use App\Models\Site;
use App\Traits\Validators\SiteValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateSite
{
    use SiteValidator;

    public function update($input, Site $site)
    {
        $rules = $this->siteRules();

        $rules['name'] = ['required', 'string', Rule::unique('sites')->ignore($site)];
        $rules['url'] = ['required', 'string', Rule::unique('sites')->ignore($site)];

        $data = Validator::make($input, $rules, [], $this->siteAttributes())->validate();

        $site->update($data);

        return $site;
    }
}
