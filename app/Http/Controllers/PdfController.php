<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    public function complaint()
    {
        $pdf = Pdf::loadView('pdf.complaint', [
            'title' => 'COMPLAINTS',
        ], [], [
            'instanceConfigurator' => function ($mpdf) {
                $mpdf->setAutoBottomMargin = 'stretch';
            },
        ]);

        return $pdf->stream('complaint.pdf');
    }
}
