<?php

namespace App\Http\Livewire\Claims;

use App\Actions\Claim\GenerateClaimReport;
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
        return view('livewire.claims.report');
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
            'created_from' => '',
            'created_to' => '',
        ];
    }

    public function show()
    {
        $this->resetInput();

        $this->showModal = true;
    }

    public function generate(GenerateClaimReport $action)
    {
        $this->pdfUrl = $action->generate($this->input);

        $this->showPdf = true;
    }
}
