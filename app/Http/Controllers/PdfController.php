<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    public function complaint()
    {
        $pdf = Pdf::loadView('pdf.complaint', [
            'title' => 'COMPLAINTS'
        ]);

        return $pdf->stream('complaint.pdf');
    }
}
