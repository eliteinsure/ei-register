<?php

namespace App\Http\Livewire\Claims;

use App\Models\Claim;
use App\Traits\WithColumnSorter;
use Exception;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithColumnSorter;

    public $claimId;

    public $search;

    public $showDelete = false;

    protected $listeners = ['render'];

    public function getClaimProperty()
    {
        return Claim::findOrFail($this->claimId);
    }

    public function render()
    {
        $query = Claim::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $stringColumns = ['client_name', 'insurer', 'policy_number', 'nature', 'status'];

                $dateColumns = ['created_at'];

                $jsonColumns = ['type'];

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

                foreach ($jsonColumns as $column) {
                    $query->orWhereJsonContains('type', [$this->search]);
                }
            });
        });

        $query = $this->sortQuery($query);

        $claims = $query->paginate();

        return view('livewire.claims.index', compact('claims'));
    }

    public function updatingSearch()
    {
        $this->resetPage();

        $this->resetSort();
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->claimId = $id;

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->claim->delete();

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Claim has been deleted.',
        ]);
    }
}
