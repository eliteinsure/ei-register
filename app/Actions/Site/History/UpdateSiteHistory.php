<?php

namespace App\Actions\Site\History;

use App\Models\SiteHistory;
use App\Traits\Validators\SiteHistoryValidator;
use Illuminate\Support\Facades\Validator;

class UpdateSiteHistory
{
    use SiteHistoryValidator;

    public function update($input, SiteHistory $siteHistory)
    {
        $data = Validator::make($input, $this->siteHistoryRules(), [], $this->siteHistoryAttributes())->validate();

        $siteHistory->update($data);

        $siteHistory->site()->first()->update([
            'update_date' => $siteHistory->site()->first()->histories()->latest('update_date')->first()->update_date,
        ]);
    }
}
