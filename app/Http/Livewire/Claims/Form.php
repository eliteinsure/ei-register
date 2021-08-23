<?php

namespace App\Http\Livewire\Claims;

use App\Actions\Claim\CreateClaim;
use App\Actions\Claim\UpdateClaim;
use App\Models\Claim;
use App\Traits\Validators\FocusError;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $claimId;

    public $input;

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
            return auth()->user()->hasRole('admin') ? 'Edit Claim' : 'Claim Details';
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

    public function resetInput()
    {
        $this->input = [];
    }

    public function add()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->claimid = null;

        $this->resetInput();

        $this->dispatchBrowserEvent('client-lookup-value');

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

        $client = json_encode([[
            'value' => $this->input['client_name'],
            'label' => $this->input['client_name'],
        ]]);

        $this->dispatchBrowserEvent('client-lookup-value', $client);

        $this->showModal = true;
    }

    public function clientLookupSearch($search = '')
    {
        $clients = Claim::select('client_name')->groupBy('client_name')
            ->when($search, function ($query) use ($search) {
                return $query->where('client_name', 'like', '%' . $search . '%');
            })->oldest('client_name')->get()->map(function ($claim) {
                return [
                    'value' => $claim->client_name,
                    'label' => $claim->client_name,
                ];
            });

        $this->dispatchBrowserEvent('client-lookup-list', $clients);
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

        $action->create($this->input);

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
            'message' => 'Claim has been edited.',
        ]);
    }
}
