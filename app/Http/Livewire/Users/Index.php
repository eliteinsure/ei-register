<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Traits\WithColumnSorter;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithColumnSorter;

    public $userId;

    public $search;

    public $showDelete = false;

    protected $listeners = ['render'];

    public function render()
    {
        $query = User::select('users.id', 'users.name', 'users.email')
            ->where('users.id', '!=', auth()->user()->id)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $stringColumns = ['users.name', 'users.email'];

                    foreach ($stringColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $this->search . '%');
                    }
                });
            });

        $query = $this->sortQuery($query, 'users.id');

        $users = $query->paginate();

        return view('livewire.users.index', compact('users'));
    }

    public function updatingSearch()
    {
        $this->resetPage();

        $this->resetSort();
    }

    public function edit($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        abort_if($id == auth()->user()->id, 404);

        $user = User::findOrFail($id);

        $this->emitTo('users.form', 'edit', $user->id);
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        abort_if($id == auth()->user()->id, 404);

        $this->userId = User::findOrFail($id)->id;

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        abort_if($this->userId == auth()->user()->id, 404);

        User::findOrFail($this->userId)->delete();

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'User has been deleted.',
        ]);
    }
}
