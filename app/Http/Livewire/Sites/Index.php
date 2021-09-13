<?php

namespace App\Http\Livewire\Sites;

use App\Actions\Site\DeleteSite;
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

    public $search;

    public $showDelete = false;

    protected $listeners = ['render'];

    public function getSiteProperty()
    {
        return Site::findOrFail($this->siteId);
    }

    public function render()
    {
        $query = Site::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $stringColumns = ['name', 'url', 'description'];

                $dateColumns = ['launch_date', 'update_date'];

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

        $sites = $query->paginate();

        return view('livewire.sites.index', compact('sites'));
    }

    public function updatingSearch()
    {
        $this->resetPage();

        $this->resetSort();
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->siteId = $id;

        abort_if($this->site->histories()->count(), 403, 'Could not delete software. Please make sure that there are no software histories with this software.');

        $this->showDelete = true;
    }

    public function delete(DeleteSite $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        abort_if($this->site->histories()->count(), 403, 'Could not delete software. Please make sure that there are no software histories with this software.');

        $action->delete($this->site);

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Software has been deleted.',
        ]);
    }
}
