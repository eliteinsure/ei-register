<?php

namespace App\Http\Livewire\Claims;

use App\Actions\Claim\CreateClaim;
use App\Actions\Claim\CreateClaimNote;
use App\Actions\Claim\UpdateClaim;
use App\Models\Adviser;
use App\Models\Claim;
use App\Traits\Validators\FocusError;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $claimId;

    public $input;

    public $notesInput;

    public $showModal = false;

    public $options = [
        'insurers' => [],
        'natures' => [],
        'types' => [],
        'status' => [],
    ];

    protected $listeners = ['add', 'edit'];

    public function getTitleProperty()
    {
        if ($this->claimId) {
            return auth()->user()->hasRole('admin') ? 'Update Claim' : 'Claim Details';
        } else {
            return 'Register a Claim';
        }
    }

    public function getClaimProperty()
    {
        return Claim::findOrFail($this->claimId);
    }

    public function mount()
    {
        $this->resetInput();

        foreach ($this->options as $key => $option) {
            $this->options[$key] = collect(config('services.' . ('insurers' == $key ? 'complaint' : 'claim') . '.' . $key))->map(function ($item) {
                return [
                    'value' => $item,
                    'label' => $item,
                ];
            })->all();
        }
    }

    public function render()
    {
        return view('livewire.claims.form');
    }

    public function updated($name, $value)
    {
        if ('input.type' == $name) {
            if ($value) {
                $this->input['type'] = explode(',', $value);
            } else {
                unset($this->input['type']);
            }
        }
    }

    public function resetInput()
    {
        $this->input = [];

        $this->notesInput = [];

        $this->dispatchBrowserEvent('adviser-lookup-value');

        $this->dispatchBrowserEvent('type-lookup-value');
    }

    public function add()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->claimId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->claimId = $id;

        $this->input = collect($this->claim)->except([
            'id',
            'created_at',
            'updated_at',
        ])->all();

        $this->notesInput = [];

        $adviser = Adviser::find($this->input['adviser_id']);

        $adviser = json_encode([[
            'value' => $adviser->id,
            'label' => $adviser->name,
        ]]);

        $this->dispatchBrowserEvent('adviser-lookup-value', $adviser);

        $type = collect($this->input['type'])->map(function ($type) {
            return [
                'value' => $type,
                'label' => $type,
            ];
        })->toJson();

        $this->dispatchBrowserEvent('type-lookup-value', $type);

        $this->showModal = true;
    }

    public function adviserLookupSearch($search = '')
    {
        $query = Adviser::where(function ($query) {
            $query->where('status', 'Active')
                ->where('type', 'Adviser');
        })->when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->oldest('name');

        $advisers = $query->get()->map(function ($adviser) {
            return [
                'value' => $adviser['id'],
                'label' => $adviser['name'],
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

        $this->claimId ? $this->update(new UpdateClaim()) : $this->create(new CreateClaim());
    }

    public function create(CreateClaim $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->input, $this->notesInput);

        $this->emitTo('claims.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Claim has been registered.',
        ]);
    }

    public function update(UpdateClaim $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->claim);

        $this->emitTo('claims.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Claim has been updated.',
        ]);
    }

    public function createClaimNote(CreateClaimNote $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->notesInput, $this->claim);

        $this->emit('claimNotesCreated');

        $this->notesInput = [];
    }
}
