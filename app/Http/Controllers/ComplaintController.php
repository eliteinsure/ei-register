<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('complaints.index');
    }

    public function report()
    {
    }

    public function pdf(Complaint $complaint)
    {
        $pdf = Pdf::loadView('pdf.complaints.show', [
            'title' => 'Complaint',
            'complaint' => $complaint,
        ]/* , [], [
            'instanceConfigurator' => function ($mpdf) {
                $mpdf->shrink_tables_to_fit = 1;
            },
        ] */);

        return $pdf->stream('complaint.pdf');
    }
}
