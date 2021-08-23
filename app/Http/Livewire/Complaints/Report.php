<?php

namespace App\Http\Livewire\Complaints;

use App\Actions\Complaint\GenerateComplaintReport;
use App\Models\Adviser;
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
        return view('livewire.complaints.report');
    }

    public function mount()
    {
        $this->resetInput();
    }

    public function updated($name, $value)
    {
        if ('input.advisers' == $name) {
            if ($value) {
                $this->input['advisers'] = explode(',', $value);
            } else {
                unset($this->input['advisers']);
            }
        }
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function resetInput()
    {
        $this->input = [
            'received_from' => '',
            'received_to' => '',
        ];

        $this->dispatchBrowserEvent('advisers-lookup-value');
    }

    public function show()
    {
        $this->resetInput();

        $this->showModal = true;
    }

    public function advisersLookupSearch($search = '')
    {
        $query = Adviser::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->oldest('name');

        $advisers = $query->get()->map(function ($adviser) {
            return [
                'value' => $adviser['id'],
                'label' => $adviser['name'],
            ];
        });

        $this->dispatchBrowserEvent('advisers-lookup-list', $advisers);
    }

    public function generate(GenerateComplaintReport $action)
    {
        $this->pdfUrl = $action->generate($this->input);

        $this->showPdf = true;
    }
}
