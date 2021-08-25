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

    public $showPdf = false;

    protected $listeners = ['render'];

    public function getComplaintProperty()
    {
        return Complaint::findOrFail($this->complaintId);
    }

    public function getPdfUrlProperty()
    {
        if (! $this->complaintId) {
            return '';
        }

        return route('reports.complaints.pdf', ['complaint' => $this->complaintId, 'now' => time()]);
    }

    public function render()
    {
        $query = Complaint::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $stringColumns = ['id', 'complainant', 'label', 'policy_number', 'insurer', 'nature'];

                $dateColumns = ['received_at', 'created_at', 'acknowledged_at'];

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

        $query = $this->sortQuery($query);

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
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->complaintId = $id;

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->complaint->delete();

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Complaint has been deleted.',
        ]);
    }

    public function showPdf($id)
    {
        $this->complaintId = $id;

        $this->showPdf = true;
    }
}
