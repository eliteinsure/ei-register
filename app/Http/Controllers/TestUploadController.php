<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class TestUploadController extends Controller
{
    public function create()
    {
        return view('test-upload.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'file' => [
                    'required',
                    'file',
                    'max:' . (500 * 1024),
                    'mimes:' . implode(',', config('services.site.manual.mimes')),
                    'mimetypes:' . implode(',', config('services.site.manual.mimetypes')),
                ],
            ]);

            $data['file']->store('test-upload', config('filesystems.default'));
        } catch (Exception $e) {
            dd($e);
        }

        session()->flash('flash.bannerStyle', 'success');
        session()->flash('flash.banner', 'Test file has been uploaded.');

        return redirect()->route('test-upload.create');
    }
}
