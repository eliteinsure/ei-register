<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Traits\Validators\ReportError;
use App\Traits\Validators\SiteReportValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class SiteController extends Controller
{
    use SiteReportValidator;
    use ReportError;

    public function index()
    {
        return view('sites.index');
    }

    public function report(Request $request)
    {
        $input = collect($request->all())->map(function ($item) {
            return $item ?? '';
        })->all();

        $validator = Validator::make($input, $this->siteReportRules(), [], $this->siteReportAttributes());

        if ($validator->fails()) {
            return $this->reportErrors($validator);
        }

        $data = $validator->validated();

        $query = Site::when($data['launch_from'] && $data['launch_to'], function ($query) use ($data) {
            return $query->whereBetween('launch_date', [$data['launch_from'], $data['launch_to']]);
        })->when($data['update_from'] && $data['update_to'], function ($query) use ($data) {
            return $query->whereBetween('update_date', [$data['update_from'], $data['update_to']]);
        })->oldest('name');

        $sites = $query->get();

        $pdfData = [
            'title' => 'Software Report',
            'sites' => $sites,
            'filter' => $data,
        ];

        $pdf = Pdf::loadView('pdf.sites.report', $pdfData, [], [
            'orientation' => 'landscape',
        ]);

        return $pdf->stream('software-report.pdf');
    }
}
