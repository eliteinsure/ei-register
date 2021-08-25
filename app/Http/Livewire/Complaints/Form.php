<?php

namespace App\Http\Livewire\Complaints;

use App\Actions\Complaint\CreateComplaint;
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

    public $showModal = false;

    public $options = [
        'labels' => [],
        'insurers' => [],
        'natures' => [],
        'tier.1.status' => [],
        'tier.2.staffPositions' => [],
        'tier.2.status' => [],
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
        if ('Client' == $name && 'Client' != $value) {
            unset($this->input['policy_number']);
        }

        if ('input.tier.1.status' == $name && 'Failed' != $value) {
            unset($this->input['tier'][2]);

            $this->input['tier'][2]['handed_over_at'] = '';
        }
    }

    public function resetInput()
    {
        $this->input = [
            'received_at' => '',
            'acknowledged_at' => '',
            'tier' => [
                1 => [
                    'handed_over_at' => '',
                    'stated_at' => '',
                ],
                2 => [
                    'handed_over_at' => '',
                ],
            ],
        ];

        $this->dispatchBrowserEvent('complainant-lookup-value');

        $this->dispatchBrowserEvent('adviser-lookup-value');

        $this->dispatchBrowserEvent('staff-lookup-value');
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

        $complainant = json_encode([[
            'value' => $this->input['complainant'],
            'label' => $this->input['complainant'],
        ]]);

        $this->dispatchBrowserEvent('complainant-lookup-value', $complainant);

        $adviser = Adviser::find($this->input['tier'][1]['adviser_id']);

        $adviser = json_encode([[
            'value' => $adviser->id,
            'label' => $adviser->name . " ($adviser[type])",
        ]]);

        $this->dispatchBrowserEvent('adviser-lookup-value', $adviser);

        $staff = Adviser::find($this->input['tier'][2]['staff_id'] ?? null);

        if ($staff) {
            $staff = json_encode([[
                'value' => $staff->id,
                'label' => $staff->name . " ($staff[type])",
            ]]);
        }

        $this->dispatchBrowserEvent('staff-lookup-value', $staff);

        $this->showModal = true;
    }

    public function complainantLookupSearch($search = '')
    {
        $complainants = Complaint::select('complainant')->groupBy('complainant')
            ->when($search, function ($query) use ($search) {
                return $query->where('complainant', 'like', '%' . $search . '%');
            })->oldest('complainant')->get()->map(function ($complaint) {
                return [
                    'value' => $complaint->complainant,
                    'label' => $complaint->complainant,
                ];
            });

        $this->dispatchBrowserEvent('complainant-lookup-list', $complainants);
    }

    public function adviserLookupSearch($search = '')
    {
        $query = Adviser::where('status', 'Active')
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

    public function staffLookupSearch($search = '')
    {
        $query = Adviser::where('status', 'Active')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })->oldest('name');

        $staffs = $query->get()->map(function ($staff) {
            return [
                'value' => $staff['id'],
                'label' => $staff['name'] . " ($staff[type])",
            ];
        });

        $this->dispatchBrowserEvent('staff-lookup-list', $staffs);
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

        $action->create($this->input);

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
}
