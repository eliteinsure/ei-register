<?php

namespace App\Http\Livewire\Complaints;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $complaintId;

    // public $perPage = 10;

    public $search;

    public $sortColumn = [
        'name' => '',
        'direction' => '',
    ];

    public function render()
    {
        $complaints = Complaint::latest('id')->paginate();

        return view('livewire.complaints.index', compact('complaints'));
    }
}
