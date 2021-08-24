<?php

namespace App\Http\Livewire\Advisers;

use App\Actions\Adviser\CreateAdviser;
use App\Actions\Adviser\UpdateAdviser;
use App\Models\Adviser;
use App\Traits\Validators\FocusError;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $adviserId;

    public $input;

    public $showModal = false;

    public $status;

    protected $listeners = ['add', 'edit'];

    public function getTitleProperty()
    {
        if ($this->adviserId) {
            return auth()->user()->hasRole('admin') ? 'Update Adviser' : 'Adviser Detials';
        } else {
            return 'Register an Adviser';
        }
    }

    public function getAdviserProperty()
    {
        return Adviser::findOrFail($this->adviserId);
    }

    public function mount()
    {
        $this->resetInput();

        $this->status = collect(['Active', 'Terminated'])->map(function ($status) {
            return [
                'value' => $status,
                'label' => $status,
            ];
        })->all();
    }

    public function render()
    {
        return view('livewire.advisers.form');
    }

    public function resetInput()
    {
        $this->input = [];
    }

    public function add()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->adviserId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->adviserId = $id;

        $this->input = collect($this->adviser)->except(['id', 'created_at', 'updated_at'])->all();

        $this->showModal = true;
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function submit()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->adviserId ? $this->update(new UpdateAdviser()) : $this->create(new CreateAdviser());
    }

    public function create(CreateAdviser $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->input);

        $this->emitTo('advisers.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Adviser has been registered.',
        ]);
    }

    public function update(UpdateAdviser $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->adviser);

        $this->emitTo('advisers.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Adviser has been updated.',
        ]);
    }
}
