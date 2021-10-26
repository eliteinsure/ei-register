<?php

namespace App\Http\Livewire\VulnerableClients;

use App\Actions\VulnerableClient\GenerateVulnerableClientReport;
use App\Traits\Validators\FocusError;
use Livewire\Component;

class Report extends Component
{
    use FocusError;

    public $input;

    public $showModal = false;

    public $showPdf = false;

    public $pdfUrl;

    public function render()
    {
        return view('livewire.vulnerable-clients.report');
    }

    public function mount()
    {
        $this->resetInput();
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function resetInput()
    {
        $this->input = [
            'issued_from' => '',
            'issued_to' => '',
        ];
    }

    public function show()
    {
        abort_unless(auth()->user()->hasPermissionTo('vulnerable-clients.generate-report'), 403);

        $this->resetInput();

        $this->showModal = true;
    }

    public function generate(GenerateVulnerableClientReport $action)
    {
        abort_unless(auth()->user()->hasPermissionTo('vulnerable-clients.generate-report'), 403);

        $this->pdfUrl = $action->generate($this->input);

        $this->showPdf = true;
    }
}
