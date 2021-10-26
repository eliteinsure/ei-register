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

    public $types;

    public $options = [
        'types' => [],
        'status' => [],
    ];

    protected $listeners = ['add', 'edit'];

    public function getTitleProperty()
    {
        if ($this->adviserId) {
            return auth()->user()->hasRole('admin') ? 'Update Adviser / Staff' : 'Adviser / Staff Detials';
        } else {
            return 'Register an Adviser / Staff';
        }
    }

    public function getAdviserProperty()
    {
        return Adviser::findOrFail($this->adviserId);
    }

    public function mount()
    {
        $this->resetInput();

        foreach ($this->options as $key => $option) {
            $this->options[$key] = collect(config('services.adviser.' . $key))->map(function ($item) {
                return [
                    'value' => $item,
                    'label' => $item,
                ];
            })->all();
        }
    }

    public function render()
    {
        return view('livewire.advisers.form');
    }

    public function updated($name, $value)
    {
        if ('input.type' == $name && 'Adviser' != $value) {
            unset($this->input['fsp_no']);
        }
    }

    public function resetInput()
    {
        $this->input = [];
    }

    public function add()
    {
        abort_unless(auth()->user()->hasPermissionTo('advisers.create'), 403);

        $this->adviserId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        abort_unless(auth()->user()->hasPermissionTo('advisers.update'), 403);

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
        $this->adviserId ? $this->update(new UpdateAdviser()) : $this->create(new CreateAdviser());
    }

    public function create(CreateAdviser $action)
    {
        abort_unless(auth()->user()->hasPermissionTo('advisers.create'), 403);

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
        abort_unless(auth()->user()->hasPermissionTo('advisers.update'), 403);

        $action->update($this->input, $this->adviser);

        $this->emitTo('advisers.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Adviser has been updated.',
        ]);
    }
}
