<?php

namespace App\Http\Livewire\VulnerableClients;

use App\Actions\VulnerableClient\UpdateVulnerableClientNote;
use App\Models\VulnerableClient;
use Livewire\Component;

class UpdateNotes extends Component
{
    public $clientId;

    public $noteId;

    public $showModal;

    public $input = [
        'created_at' => '',
    ];

    protected $listeners = ['show'];

    public function getClientProperty()
    {
        return VulnerableClient::findOrFail($this->clientId);
    }

    public function getNoteProperty()
    {
        return $this->client->notes()->findOrFail($this->noteId);
    }

    public function render()
    {
        return view('livewire.vulnerable-clients.update-notes');
    }

    public function show($clientId, $noteId)
    {
        abort_unless(auth()->user()->hasPermissionTo('vulnerable-client-notes.update'), 403);

        $this->clientId = $clientId;

        $this->noteId = $noteId;

        $this->input = $this->note->only(['created_at', 'notes']);
        $this->input['created_time'] = $this->note->created_at->format('H:i');

        $this->showModal = true;
    }

    public function submit(UpdateVulnerableClientNote $action)
    {
        abort_unless(auth()->user()->hasPermissionTo('vulnerable-client-notes.update'), 403);

        $action->update($this->input, $this->note);

        $this->showModal = false;

        $this->emitTo('vulnerable-clients.notes', 'render');
    }
}
