<?php

namespace App\Actions\Site\Manual;

use App\Models\Site;
use App\Traits\Validators\SiteManualValidator;
use Illuminate\Support\Facades\Validator;

class UploadManual
{
    use SiteManualValidator;

    public function upload($input, Site $site)
    {
        $data = Validator::make($input, $this->siteManualRules($site), [], $this->siteManualAttributes())->validate();

        $data['file'] = $data['file']->store('site-manuals', config('filesystems.default'));

        $data['disk'] = config('filesystems.default');

        $manual = $site->manuals()->create($data);

        return $manual;
    }
}
