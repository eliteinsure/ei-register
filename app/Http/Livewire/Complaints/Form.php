<?php

namespace App\Http\Livewire\Complaints;

use App\Actions\Complaint\CreateComplaint;
use App\Actions\Complaint\CreateComplaintNote;
use App\Actions\Complaint\UpdateComplaint;
use App\Models\Adviser;
use App\Models\Complaint;
use App\Traits\Validators\FocusError;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $complaintId;

    public $input;

    public $tierNotesInput;

    public $showModal = false;

    public $options = [
        'labels' => [],
        'insurers' => [],
        'natures' => [],
        'tier.tier' => [],
        'tier.handlers' => [],
        'tier.status' => [],
    ];

    protected $listeners = ['add', 'edit'];

    public function getTitleProperty()
    {
        if ($this->complaintId) {
            return auth()->user()->hasRole('admin') ? 'Update Complaint' : 'Complaint Detials';
        } else {
            return 'Register a Complaint';
        }
    }

    public function getComplaintProperty()
    {
        return Complaint::findOrFail($this->complaintId);
    }

    public function mount()
    {
        $this->resetInput();

        foreach ($this->options as $key => $option) {
            $this->options[$key] = collect(config('services.complaint.' . $key))->map(function ($item) {
                return [
                    'value' => $item,
                    'label' => $item,
                ];
            })->all();
        }
    }

    public function render()
    {
        return view('livewire.complaints.form');
    }

    public function updated($name, $value)
    {
        if ('input.tier.handler' == $name) {
            unset($this->input['tier']['adviser_id']);

            $this->dispatchBrowserEvent('adviser-lookup-value');
        }
    }

    public function resetInput()
    {
        $this->input = [
            'received_at' => '',
            'acknowledged_at' => '',
            'tier' => [
                'completed_at' => '',
                'handler' => '',
            ],
        ];

        $this->tierNotesInput = [];

        $this->dispatchBrowserEvent('adviser-lookup-value');
    }

    public function add()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->complaintId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->complaintId = $id;

        $this->input = collect($this->complaint)->except([
            'id',
            'created_at',
            'updated_at',
        ])->all();

        $this->tierNotesInput = [];

        $adviser = Adviser::find($this->input['tier']['adviser_id'] ?? null);

        if ($adviser) {
            $adviser = json_encode([[
                'value' => $adviser->id,
                'label' => $adviser->name . " ($adviser[type])",
            ]]);

            $this->dispatchBrowserEvent('adviser-lookup-value', $adviser);
        }

        $this->showModal = true;
    }

    public function adviserLookupSearch($search = '')
    {
        $query = Adviser::where('type', $this->input['tier']['handler'])
            ->where('status', 'Active')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })->oldest('name');

        $advisers = $query->get()->map(function ($adviser) {
            return [
                'value' => $adviser['id'],
                'label' => $adviser['name'] . " ($adviser[type])",
            ];
        });

        $this->dispatchBrowserEvent('adviser-lookup-list', $advisers);
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function submit()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->complaintId ? $this->update(new UpdateComplaint()) : $this->create(new CreateComplaint());
    }

    public function create(CreateComplaint $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->input, $this->tierNotesInput);

        $this->emitTo('complaints.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Complaint has been registered.',
        ]);
    }

    public function update(UpdateComplaint $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->complaint);

        $this->emitTo('complaints.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Complaint has been updated.',
        ]);
    }

    public function createTierNote(CreateComplaintNote $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->tierNotesInput, $this->complaint);

        $this->emit('tierNotesCreated');

        $this->tierNotesInput = [];
    }
}
