<?php

namespace App\Http\Livewire\VulnerableClients;

use App\Models\VulnerableClient;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public $clientId;

    public $noteId;

    public $showModal = false;

    public $showDelete = false;

    protected $listeners = ['show', 'render'];

    public function getClientProperty()
    {
        return VulnerableClient::find($this->clientId);
    }

    public function getNoteProperty()
    {
        return $this->client->notes()->findOrFail($this->noteId);
    }

    public function render()
    {
        $notes = collect([]);

        if ($this->clientId) {
            $notes = $this->client->notes()->paginate();
        }

        return view('livewire.vulnerable-clients.notes', compact('notes'));
    }

    public function show($clientId)
    {
        $this->clientId = $clientId;

        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->noteId = $id;

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->note->delete();

        $this->showDelete = false;
    }
}
