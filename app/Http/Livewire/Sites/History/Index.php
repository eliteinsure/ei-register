<?php

namespace App\Http\Livewire\Sites\History;

use App\Models\Site;
use App\Traits\WithColumnSorter;
use Exception;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithColumnSorter;

    public $siteId;

    public $historyId;

    public $search;

    public $showDelete = false;

    protected $listeners = ['render'];

    public function getSiteProperty()
    {
        return Site::findOrFail($this->siteId);
    }

    public function getSiteHistoryProperty()
    {
        return $this->site->histories()->findOrFail($this->historyId);
    }

    public function mount($siteId)
    {
        $this->siteId = $siteId;
    }

    public function render()
    {
        $query = $this->site->histories()->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $stringColumns = ['updates', 'developer', 'version'];

                $dateColumns = ['update_date'];

                foreach ($stringColumns as $column) {
                    $query->orWhere($column, 'like %' . $this->search . '%');
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

        $histories = $query->paginate();

        return view('livewire.sites.history.index', compact('histories'));
    }

    public function updatingSearch()
    {
        $this->resetPage();

        $this->resetSort();
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->historyId = $id;

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->siteHistory->delete();

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Software history has been deleted.',
        ]);

        $this->showDelete = false;
    }
}
