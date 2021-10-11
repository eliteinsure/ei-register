<?php

namespace App\Http\Livewire\Claims;

use App\Models\Claim;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public $claimId;

    public $noteId;

    public $showModal = false;

    public $showDelete = false;

    protected $listeners = ['show', 'render'];

    public function getClaimProperty()
    {
        return Claim::find($this->claimId);
    }

    public function getNoteProperty()
    {
        return $this->claim->notes()->findOrFail($this->noteId);
    }

    public function render()
    {
        $notes = collect([]);

        if ($this->claimId) {
            $notes = $this->claim->notes()->paginate();
        }

        return view('livewire.claims.notes', compact('notes'));
    }

    public function show($claimId)
    {
        $this->claimId = $claimId;

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
