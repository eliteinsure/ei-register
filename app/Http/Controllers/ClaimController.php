<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\Claim;
use App\Traits\Validators\ClaimReportValidator;
use App\Traits\Validators\ReportError;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ClaimController extends Controller
{
    use ClaimReportValidator;
    use ReportError;

    public function index()
    {
        return view('claims.index');
    }

    public function report(Request $request)
    {
        $input = collect($request->all())->map(function ($item) {
            return $item ?? '';
        })->all();

        $validator = Validator::make($input, $this->claimReportRules(), [], $this->claimReportAttributes());

        if ($validator->fails()) {
            return $this->reportErrors($validator);
        }

        $data = $validator->validated();

        $query = Claim::with('adviser:id,name as adviser_name,type as adviser_type')
            ->whereBetween('created_at', [
                Carbon::parse($data['created_from'])->startOfDay()->format('Y-m-d H:i:s'),
                Carbon::parse($data['created_to'])->endOfDay()->format('Y-m-d H:i:s'),
            ])->when(isset($data['advisers']), function ($query) use ($data) {
                return $query->whereIn('adviser_id', $data['advisers']);
            })->oldest('created_at');

        $claims = $query->get();

        $pdfData = [
            'title' => 'Claims Report',
            'claims' => $claims,
            'filter' => $data,
        ];

        if (isset($data['advisers'])) {
            $advisers = Adviser::whereIn('id', $data['advisers'])->oldest('name')->pluck('name');

            $pdfData['advisers'] = $advisers;
        }

        $pdf = Pdf::loadView('pdf.claims.report', $pdfData, [], [
            'orientation' => 'landscape',
            'instanceConfigurator' => function ($mpdf) {
                $mpdf->setAutoBottomMargin = 'stretch';
            },
        ]);

        return $pdf->stream('claims-report.pdf');
    }
}
