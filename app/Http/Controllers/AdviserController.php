<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdviserController extends Controller
{
    public function index()
    {
        return view('advisers.index');
    }
}
