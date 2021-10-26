<?php

namespace App\Http\Livewire\Claims;

use App\Actions\Claim\UpdateClaimNote;
use App\Models\Claim;
use Livewire\Component;

class UpdateNotes extends Component
{
    public $claimId;

    public $noteId;

    public $showModal;

    public $input = [
        'created_at' => '',
    ];

    protected $listeners = ['show'];

    public function getClaimProperty()
    {
        return Claim::findOrFail($this->claimId);
    }

    public function getNoteProperty()
    {
        return $this->claim->notes()->findOrFail($this->noteId);
    }

    public function render()
    {
        return view('livewire.claims.update-notes');
    }

    public function show($claimId, $noteId)
    {
        abort_unless(auth()->user()->hasPermissionTo('claim-notes.update'), 403);

        $this->claimId = $claimId;

        $this->noteId = $noteId;

        $this->input = $this->note->only(['created_at', 'notes']);
        $this->input['created_time'] = $this->note->created_at->format('H:i');

        $this->showModal = true;
    }

    public function submit(UpdateClaimNote $action)
    {
        abort_unless(auth()->user()->hasPermissionTo('claim-notes.update'), 403);

        $action->update($this->input, $this->note);

        $this->showModal = false;

        $this->emitTo('claims.notes', 'render');
    }
}
