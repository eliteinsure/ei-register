<?php

namespace App\Http\Livewire\Complaints;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public $complaintId;

    public $tier;

    public $showModal = false;

    protected $listeners = ['show'];

    public function getComplaintProperty()
    {
        return Complaint::find($this->complaintId);
    }

    public function render()
    {
        $notes = collect([]);

        if ($this->complaintId) {
            $notes = $this->complaint->notes()->where('tier', $this->tier)->paginate(2);
        }

        return view('livewire.complaints.notes', compact('notes'));
    }

    public function show($complaintId, $tier)
    {
        $this->complaintId = $complaintId;

        $this->tier = $tier;

        $this->showModal = true;
    }
}
