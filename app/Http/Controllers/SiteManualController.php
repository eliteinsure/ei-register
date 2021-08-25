<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteManualController extends Controller
{
    public function show(Site $site, $manual)
    {
        $manual = $site->manuals()->findOrFail($manual);

        // return Storage::disk($manual->disk)->download($manual->file, $manual->filename);

        return Storage::disk($manual->disk)->response($manual->file, $manual->filename);
    }
}
