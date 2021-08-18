<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\Complaint;
use App\Traits\Validators\ComplaintReportValidator;
use App\Traits\Validators\ReportError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ComplaintController extends Controller
{
    use ComplaintReportValidator;
    use ReportError;

    public function index()
    {
        return view('complaints.index');
    }

    public function report(Request $request)
    {
        $input = collect($request->all())->map(function ($item) {
            return $item ?? '';
        })->all();

        $validator = Validator::make($input, $this->complaintReportRules(), [], $this->complaintReportAttributes());

        if ($validator->fails()) {
            return $this->reportErrors($validator);
        }

        $data = $validator->validated();

        $query = Complaint::whereBetween('received_at', [$data['received_from'], $data['received_to']])
            ->when(isset($data['advisers']), function ($query) use ($data) {
                return $query->where(function ($query) use ($data) {
                    foreach ($data['advisers'] as $adviser) {
                        $query->orWhereJsonContains('tier->1->adviser_id', $adviser);
                    }
                });
            })->oldest('received_at');

        $complaints = $query->get();

        $pdfData = [
            'title' => 'Complaints Report',
            'complaints' => $complaints,
            'filter' => $data,
        ];

        if (isset($data['advisers'])) {
            $advisers = Adviser::whereIn('id', $data['advisers'])->oldest('name')->pluck('name');

            $pdfData['advisers'] = $advisers;
        }

        $pdf = Pdf::loadView('pdf.complaints.report', $pdfData);

        return $pdf->stream('complaints-report.pdf');
    }

    public function pdf(Complaint $complaint)
    {
        $pdf = Pdf::loadView('pdf.complaints.show', [
            'title' => 'Complaint',
            'complaint' => $complaint,
        ]);

        return $pdf->stream('complaint.pdf');
    }
}
