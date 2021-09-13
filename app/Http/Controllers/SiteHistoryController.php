<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteHistoryController extends Controller
{
    public function index(Site $site)
    {
        return view('sites.history.index', compact('site'));
    }
}
