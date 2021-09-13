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

        $site = Site::create($data);

        return $site;
    }
}
