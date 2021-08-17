<?php

namespace App\Actions\Site;

use App\Models\Site;
use Illuminate\Support\Facades\Storage;

class DeleteSite
{
    public function delete(Site $site)
    {
        foreach ($site->manuals as $manual) {
            Storage::disk($manual->disk)->delete($manual->file);
        }

        $site->manuals()->delete();

        $site->delete();
    }
}
