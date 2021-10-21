<?php

namespace App\Http\Livewire\VulnerableClients;

use App\Actions\VulnerableClient\CreateVulnerableClient;
use App\Actions\VulnerableClient\CreateVulnerableClientNote;
use App\Actions\VulnerableClient\UpdateVulnerableClient;
use App\Models\VulnerableClient;
use App\Traits\Validators\FocusError;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $clientId;

    public $input;

    public $notesInput;

    public $showModal = false;

    public $options = [
        'insurers' => [],
        'natures' => [],
    ];

    protected $listeners = ['add', 'edit'];

    public function getTitleProperty()
    {
        if ($this->clientId) {
            return auth()->user()->hasRole('admin') ? 'Update Vulnerable Client' : 'Vulnerable Client Details';
        } else {
            return 'Registers a Vulnerable Client';
        }
    }

    public function getClientProperty()
    {
        return VulnerableClient::findOrFail($this->clientId);
    }

    public function mount()
    {
        $this->resetInput();

        foreach ($this->options as $key => $option) {
            $this->options[$key] = collect(config('services.' . ('insurers' == $key ? 'complaint' : 'vulnerableClients') . '.' . $key))->map(function ($item) {
                return [
                    'value' => $item,
                    'label' => $item,
                ];
            })->all();
        }
    }

    public function render()
    {
        return view('livewire.vulnerable-clients.form');
    }

    public function resetInput()
    {
        $this->input = [
            'issued_at' => '',
        ];

        $this->notesInput = [];
    }

    public function add()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->clientId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->clientId = $id;

        $this->input = collect($this->client)->except([
            'id',
            'created_at',
            'updated_at',
        ])->all();

        $this->notesInput = [];

        $this->showModal = true;
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function submit()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->clientId ? $this->update(new UpdateVulnerableClient()) : $this->create(new CreateVulnerableClient());
    }

    public function create(CreateVulnerableClient $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->input, $this->notesInput);

        $this->emitTo('vulnerable-clients.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Vulnerable client has been registered.',
        ]);
    }

    public function update(UpdateVulnerableClient $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->client);

        $this->emitTo('vulnerable-clients.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Vulnerable client has been updated.',
        ]);
    }

    public function createVulnerableClientNote(CreateVulnerableClientNote $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->notesInput, $this->client);

        $this->emit('vulnerableClientNotesCreated');

        $this->notesInput = [];
    }
}
