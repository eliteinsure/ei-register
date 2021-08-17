<?php

namespace App\Actions\Site\Manual;

use App\Models\SiteManual;
use Illuminate\Support\Facades\Storage;

class DeleteManual
{
    public function delete(SiteManual $manual)
    {
        Storage::disk($manual['disk'])->delete($manual->file);

        $manual->delete();
    }
}
