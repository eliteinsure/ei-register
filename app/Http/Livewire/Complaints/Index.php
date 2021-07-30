<?php

namespace App\Http\Livewire\Complaints;

use App\Models\Complaint;
use Exception;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $complaintId;

    public $search;

    public $sortColumn = [
        'name' => '',
        'direction' => '',
    ];

    public function render()
    {
        $complaints = Complaint::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $stringColumns = ['id', 'complainant', 'label', 'policy_number', 'insurer', 'nature'];

                $dateColumns = ['received_at', 'registered_at', 'acknowledged_at'];

                foreach ($stringColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $this->search . '%');
                }

                foreach ($dateColumns as $column) {
                    try {
                        $date = Carbon::createFromFormat('d/m/Y', $this->search);
                    } catch (Exception $e) {
                        continue;
                    }

                    $query->orWhere($column, 'like', '%' . $date->format('Y-m-d') . '%');
                }
            });
        })->latest('id')->paginate();

        return view('livewire.complaints.index', compact('complaints'));
    }
}
