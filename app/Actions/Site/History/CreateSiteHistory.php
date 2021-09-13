<?php

namespace App\Actions\Site\History;

use App\Models\Site;
use App\Traits\Validators\SiteHistoryValidator;
use Illuminate\Support\Facades\Validator;

class CreateSiteHistory
{
    use SiteHistoryValidator;

    public function create($input, Site $site)
    {
        $data = Validator::make($input, $this->siteHistoryRules(), [], $this->siteHistoryAttributes())->validate();

        $siteHistory = $site->histories()->create($data);

        return $siteHistory;
    }
}
