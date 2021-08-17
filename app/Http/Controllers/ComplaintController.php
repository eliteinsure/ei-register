<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\Complaint;
use App\Traits\Validators\ComplaintReportValidator;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ComplaintController extends Controller
{
    use ComplaintReportValidator;

    public function index()
    {
        return view('complaints.index');
    }

    public function report(Request $request)
    {
        $data = $request->validate($this->complaintReportRules(), [], $this->complaintReportAttributes());

        $query = Complaint::whereBetween('received_at', [$data['received_from'], $data['received_to']])
            ->when(isset($data['advisers']), function ($query) use ($data) {
                return $query->where(function ($query) use ($data) {
                    foreach ($data['advisers'] as $adviser) {
                        $query->orWhereJsonContains('tier->1->adviser_id', intval($adviser));
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
