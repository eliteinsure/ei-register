<?php

namespace App\Http\Livewire\Complaints;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public $complaintId;

    public $noteId;

    public $showModal = false;

    public $showDelete = false;

    protected $listeners = ['show', 'render'];

    public function getComplaintProperty()
    {
        return Complaint::find($this->complaintId);
    }

    public function getNoteProperty()
    {
        return $this->complaint->notes()->findOrFail($this->noteId);
    }

    public function render()
    {
        $notes = collect([]);

        if ($this->complaintId) {
            $notes = $this->complaint->notes()->paginate();
        }

        return view('livewire.complaints.notes', compact('notes'));
    }

    public function show($complaintId)
    {
        $this->complaintId = $complaintId;

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
