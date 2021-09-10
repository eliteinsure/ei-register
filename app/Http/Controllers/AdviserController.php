<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class AdviserController extends Controller
{
    public function index()
    {
        return view('advisers.index');
    }

    public function pdf(Adviser $adviser)
    {
        $pdf = Pdf::loadView('pdf.advisers.show', [
            'title' => 'Adviser',
            'adviser' => $adviser,
        ], [], [
            'instanceConfigurator' => function ($mpdf) {
                $mpdf->setAutoBottomMargin = 'stretch';
            },
        ]);

        return $pdf->stream('adviser.pdf');
    }
}
