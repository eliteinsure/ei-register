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

    public $showPdf = false;

    protected $listeners = ['render'];

    public function getClaimProperty()
    {
        return Claim::findOrFail($this->claimId);
    }

    public function getPdfUrlProperty()
    {
        if (! $this->claimId) {
            return '';
        }

        return route('reports.claims.pdf', ['claim' => $this->claimId, 'now' => time()]);
    }

    public function render()
    {
        $columns = [
            'claims.id',
            'claims.client_name',
            'claims.insurer',
            'claims.policy_number',
            'claims.nature',
            'claims.type',
            'claims.status',
            'claims.created_at',
            'advisers.name',
        ];

        $query = Claim::with('adviser:id,name as adviser_name,type as adviser_type')
            ->leftJoin('advisers', 'advisers.id', '=', 'claims.adviser_id')
            ->select('claims.*', 'advisers.name', 'claims.type as claim_type')
            ->when($this->search, function ($query) use ($columns) {
                return $query->where(function ($query) use ($columns) {
                    $stringColumns = collect($columns)->reject(function ($item) {
                        return in_array($item, ['claims.created_at', 'claims.type']);
                    })->all();

                    $dateColumns = ['claims.created_at'];

                    $jsonColumns = ['claims.type'];

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
                        $query->orWhereJsonContains($column, [$this->search]);
                    }
                });
            });

        $query = $this->sortQuery($query, 'claims.created_at', 'desc');

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

    public function showPdf($id)
    {
        $this->claimId = $id;

        $this->showPdf = true;
    }
}
