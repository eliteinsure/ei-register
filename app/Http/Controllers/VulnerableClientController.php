<?php

namespace App\Http\Controllers;

use App\Models\VulnerableClient;
use App\Traits\Validators\VulnerableClientReportValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class VulnerableClientController extends Controller
{
    use VulnerableClientReportValidator;

    public function index()
    {
        return view('vulnerable-clients.index');
    }

    public function report(Request $request)
    {
        $input = collect($request->all())->map(function ($item) {
            return $item ?? '';
        })->all();

        $validator = Validator::make($input, $this->vulnerableClientReportRules(), [], $this->vulnerableClientReportAttributes());

        if ($validator->fails()) {
            return $this->reportErrors($validator);
        }

        $data = $validator->validated();

        $query = VulnerableClient::whereBetween('issued_at', [
            $data['issued_from'],
            $data['issued_to'],
        ])->oldest('issued_at');

        $clients = $query->get();

        $pdfData = [
            'title' => 'Vulnerable Clients Report',
            'clients' => $clients,
            'filter' => $data,
        ];

        $pdf = Pdf::loadView('pdf.vulnerable-clients.report', $pdfData, [], [
            'orientation' => 'landscape',
            'instanceConfigurator' => function ($mpdf) {
                $mpdf->setAutoBottomMargin = 'stretch';
            },
        ]);

        return $pdf->stream('vulnerable-clients-report.pdf');
    }

    public function pdf(VulnerableClient $vulnerableClient)
    {
        $pdf = Pdf::loadView('pdf.vulnerable-clients.show', [
            'title' => 'Vulnerable Client',
            'client' => $vulnerableClient,
        ], [], [
            'instanceConfigurator' => function ($mpdf) {
                $mpdf->setAutoBottomMargin = 'stretch';
            },
        ]);

        return $pdf->stream('vulnerable-client.pdf');
    }
}
