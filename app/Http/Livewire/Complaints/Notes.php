<?php

namespace App\Http\Livewire\Complaints;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public $complaintId;

    public $showModal = false;

    protected $listeners = ['show', 'render'];

    public function getComplaintProperty()
    {
        return Complaint::find($this->complaintId);
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
}
