<?php

namespace App\Http\Livewire\Advisers;

use App\Models\Adviser;
use App\Traits\WithColumnSorter;
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

    public function getAdviserProperty()
    {
        return Adviser::findOrFail($this->adviserId);
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

        abort_if($this->adviser->complaints()->count(), 403, 'Could not delete adviser. Please make sure that there are no complaints with this adviser.');

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        abort_if($this->adviser->complaints()->count(), 403, 'Could not delete adviser. Please make sure that there are no complaints with this adviser.');

        $this->adviser->delete();

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Adviser has been deleted.',
        ]);
    }
}
