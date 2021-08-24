<?php

namespace App\Http\Livewire\Sites;

use App\Actions\Site\Manual\DeleteManual;
use App\Actions\Site\Manual\UploadManual;
use App\Models\Site;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manual extends Component
{
    use WithFileUploads;

    public $siteId;

    public $input;

    public $manualId;

    public $file;

    public $showModal = false;

    public $showDelete = false;

    protected $listeners = ['show'];

    public function getSiteProperty()
    {
        return Site::findOrFail($this->siteId);
    }

    public function getManualProperty()
    {
        return $this->site->manuals()->findOrFail($this->manualId);
    }

    public function render()
    {
        $manuals = [];

        if ($this->siteId) {
            $manuals = $this->site->manuals()->oldest('name')->get();
        }

        return view('livewire.sites.manual', compact('manuals'));
    }

    public function show($id)
    {
        $this->siteId = $id;

        $this->showModal = true;
    }

    public function resetInput()
    {
        $this->input = [];

        $this->file = null;

        $this->dispatchBrowserEvent('file-filepond-reset');
    }

    public function submit(UploadManual $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->upload([
            'name' => $this->input['name'] ?? '',
            'file' => $this->file,
        ], $this->site);

        $this->resetInput();
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->manualId = $id;

        $this->showDelete = true;
    }

    public function delete(DeleteManual $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->delete($this->manual);

        $this->showDelete = false;
    }
}
