<?php

namespace App\Http\Livewire\Sites;

use App\Actions\Site\GenerateSiteReport;
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
        return view('livewire.sites.report');
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
            'launch_from' => '',
            'launch_to' => '',
            'update_from' => '',
            'update_to' => '',
        ];
    }

    public function show()
    {
        abort_unless(auth()->user()->hasPermissionTo('software.generate-report'), 403);

        $this->resetInput();

        $this->showModal = true;
    }

    public function generate(GenerateSiteReport $action)
    {
        abort_unless(auth()->user()->hasPermissionTo('software.generate-report'), 403);

        $this->pdfUrl = $action->generate($this->input);

        $this->showPdf = true;
    }
}
