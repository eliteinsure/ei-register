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

        $site->update([
            'update_date' => $site->histories()->latest('update_date')->first()->update_date,
        ]);

        return $siteHistory;
    }
}
