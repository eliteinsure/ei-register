<?php

namespace App\Http\Livewire\Complaints;

use App\Actions\Complaint\UpdateComplaintNote;
use App\Models\Complaint;
use Livewire\Component;

class UpdateNotes extends Component
{
    public $complaintId;

    public $noteId;

    public $showModal;

    public $input = [
        'created_at' => '',
    ];

    protected $listeners = ['show'];

    public function getComplaintProperty()
    {
        return Complaint::findOrFail($this->complaintId);
    }

    public function getNoteProperty()
    {
        return $this->complaint->notes()->findOrFail($this->noteId);
    }

    public function render()
    {
        return view('livewire.complaints.update-notes');
    }

    public function show($complaintId, $noteId)
    {
        $this->complaintId = $complaintId;

        $this->noteId = $noteId;

        $this->input = $this->note->only(['created_at', 'notes']);

        $this->showModal = true;
    }

    public function submit(UpdateComplaintNote $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->note);

        $this->showModal = false;

        $this->emitTo('complaints.notes', 'render');
    }
}
