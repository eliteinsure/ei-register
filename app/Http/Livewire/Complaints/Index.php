<?php

namespace App\Http\Livewire\Complaints;

use App\Models\Complaint;
use App\Traits\WithColumnSorter;
use Exception;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithColumnSorter;

    public $complaintId;

    public $search;

    public $showDelete = false;

    protected $listeners = ['render'];

    public function render()
    {
        $query = Complaint::when($this->search, function ($query) {
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
        });

        if ($this->sort['column'] && $this->sort['direction']) {
            $query->orderBy($this->sort['column'], $this->sort['direction']);
        } else {
            $query->orderBy('id', 'desc');
        }

        $complaints = $query->paginate();

        return view('livewire.complaints.index', compact('complaints'));
    }

    public function updatingSearch()
    {
        $this->resetPage();

        $this->resetSort();
    }

    public function confirmDelete($id)
    {
        $this->complaintId = Complaint::findOrFail($id)->id;

        $this->showDelete = true;
    }

    public function delete()
    {
        Complaint::findOrFail($this->complaintId)->delete();

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Complaint has been deleted.',
        ]);
    }
}
