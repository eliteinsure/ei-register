<?php

namespace App\Http\Livewire\Advisers;

use App\Models\Adviser;
use App\Traits\WithColumnSorter;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithColumnSorter;

    public $adviserId;

    public $search;

    public $showDelete = false;

    public $listeners = ['render'];

    public $tabs;

    public $currentTab;

    public $firstTab;

    public $lastTab;

    public $showPdf = false;

    public function getAdviserProperty()
    {
        return Adviser::findOrFail($this->adviserId);
    }

    public function getPdfUrlProperty()
    {
        if (! $this->adviserId) {
            return '';
        }

        return route('reports.advisers.pdf', ['adviser' => $this->adviserId, 'now' => time()]);
    }

    public function render()
    {
        $query = Adviser::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $stringColumns = ['type', 'name', 'email', 'fsp_no', 'contact_number', 'status'];

                foreach ($stringColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        });

        $query = $this->sortQuery($query, 'name', 'asc');

        $advisers = $query->paginate();

        return view('livewire.advisers.index', compact('advisers'));
    }

    public function mount()
    {
        $this->tabs = collect(config('services.adviser.requirements'))->keys()->mapWithKeys(function ($item) {
            return [$item => Str::title(Str::replace('_', ' ', $item))];
        })->prepend('Basic Information', 'basic_information')
            ->all();

        $this->firstTab = collect($this->tabs)->keys()->first();

        $this->lastTab = collect($this->tabs)->keys()->last();

        $this->currentTab = $this->firstTab;
    }

    public function updatingSearch()
    {
        $this->resetPage();

        $this->resetSort();
    }

    public function edit($id)
    {
        $this->adviserId = $id;

        $this->emitTo('advisers.form', 'edit', $this->adviser->id);
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->adviserId = $id;

        abort_if($this->adviser->adviserComplaints()->count(), 403, 'Could not delete adviser. Please make sure that there are no complaints with this adviser / staff.');

        abort_if($this->adviser->staffComplaints()->count(), 403, 'Could not delete adviser. Please make sure that there are no complaints with this adviser / staff.');

        abort_if($this->adviser->claims()->count(), 403, 'Could not delete adviser. Please make sure that there are no claims with this adviser / staff.');

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        abort_if($this->adviser->adviserComplaints()->count(), 403, 'Could not delete adviser. Please make sure that there are no complaints with this adviser / staff.');

        abort_if($this->adviser->staffComplaints()->count(), 403, 'Could not delete adviser. Please make sure that there are no complaints with this adviser / staff.');

        abort_if($this->adviser->claims()->count(), 403, 'Could not delete adviser. Please make sure that there are no claims with this adviser / staff.');

        $this->adviser->delete();

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Adviser has been deleted.',
        ]);
    }

    public function showPdf($id)
    {
        $this->adviserId = $id;

        $this->showPdf = true;
    }
}
