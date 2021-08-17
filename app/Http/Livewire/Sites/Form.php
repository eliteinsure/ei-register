<?php

namespace App\Http\Livewire\Sites;

use App\Actions\Site\CreateSite;
use App\Actions\Site\UpdateSite;
use App\Models\Site;
use App\Traits\Validators\FocusError;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $siteId;

    public $input;

    public $showModal = false;

    protected $listeners = ['add', 'edit'];

    public function getSiteProperty()
    {
        return Site::findOrFail($this->siteId);
    }

    public function render()
    {
        return view('livewire.sites.form');
    }

    public function mount()
    {
        $this->resetInput();
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function resetInput()
    {
        $this->input = [
            'launch_date' => '',
            'update_date' => '',
        ];
    }

    public function add()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->siteId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->siteId = $id;

        $this->emitTo('sites.manual', 'setSite', $id);

        $this->input = collect($this->site)->except([
            'id',
            'created_at',
            'updated_at',
        ])->all();

        $this->showModal = true;
    }

    public function submit()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->siteId ? $this->update(new UpdateSite()) : $this->create(new CreateSite());
    }

    public function create(CreateSite $action)
    {
        $action->create($this->input);

        $this->emitTo('sites.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Software has been created.',
        ]);
    }

    public function update(UpdateSite $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->site);

        $this->emitTo('sites.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Software has been updated.',
        ]);
    }
}
