<?php

namespace App\Actions\Site;

use App\Models\Site;
use App\Traits\Validators\SiteValidator;
use Illuminate\Support\Facades\Validator;

class CreateSite
{
    use SiteValidator;

    public function create($input)
    {
        $data = Validator::make($input, $this->siteRules(), [], $this->siteAttributes())->validate();

        if (! $data['update_date']) {
            $data['update_date'] = null;
        }

        $site = Site::create($data);

        return $site;
    }
}
