<?php

namespace App\Http\Livewire\Advisers;

use App\Actions\Adviser\UpdateAdviserRequirement;
use App\Models\Adviser;
use Illuminate\Support\Str;
use Livewire\Component;

class Requirement extends Component
{
    public $input;

    public $adviserId;

    public $showModal = false;

    public $tabs;

    public $currentTab;

    public $firstTab;

    public $lastTab;

    protected $listeners = ['show'];

    public function getAdviserProperty()
    {
        return Adviser::findOrFail($this->adviserId);
    }

    public function render()
    {
        return view('livewire.advisers.requirement');
    }

    public function mount()
    {
        $this->tabs = collect(config('services.adviser.requirements'))->keys()->mapWithKeys(function ($item) {
            return [$item => Str::title(Str::replace('_', ' ', $item))];
        })->all();

        $this->firstTab = collect($this->tabs)->keys()->first();

        $this->lastTab = collect($this->tabs)->keys()->last();

        $this->currentTab = $this->firstTab;

        $this->resetInput();
    }

    public function resetInput()
    {
        $this->input = [
            'adviser_requirements' => [
                'fspr' => '',
            ],
        ];
    }

    public function show($id)
    {
        $this->adviserId = $id;

        $this->input = [];

        foreach (config('services.adviser.requirements') as $requirementKey => $requirement) {
            foreach ($requirement as $subRequirementKey => $subRequirement) {
                $this->input[$requirementKey][$subRequirementKey] = $this->adviser->requirements[$requirementKey][$subRequirementKey] ?? '';
            }
        }

        $this->showModal = true;
    }

    public function getRequirementOptions($requirementKey, $subRequirementKey)
    {
        return collect(config('services.adviser.requirements.' . $requirementKey . '.' . $subRequirementKey . '.options'))->map(function ($item) {
            return [
                'value' => $item,
                'label' => $item,
            ];
        })->all();
    }

    public function submit(UpdateAdviserRequirement $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->adviser);

        $this->emitTo('advisers.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Adviser requirements has been updated.',
        ]);
    }
}
