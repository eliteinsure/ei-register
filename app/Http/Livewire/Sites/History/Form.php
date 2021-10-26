<?php

namespace App\Http\Livewire\Sites\History;

use App\Actions\Site\History\CreateSiteHistory;
use App\Actions\Site\History\UpdateSiteHistory;
use App\Models\Site;
use App\Models\SiteHistory;
use App\Traits\Validators\FocusError;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $siteId;

    public $historyId;

    public $input;

    public $showModal = false;

    protected $listeners = ['add', 'edit'];

    public function getTitleProperty()
    {
        return $this->historyId ? 'Update Software History' : 'Register a Software History';
    }

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

        $this->resetInput();
    }

    public function render()
    {
        return view('livewire.sites.history.form');
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function resetInput()
    {
        $this->input = [
            'update_date' => '',
        ];

        $this->dispatchBrowserEvent('developer-lookup-value');
    }

    public function add()
    {
        abort_unless(auth()->user()->hasPermissionTo('software-history.create'), 403);

        $this->historyId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        abort_unless(auth()->user()->hasPermissionTo('software-history.update'), 403);

        $this->historyId = $id;

        $this->input = collect($this->siteHistory)->except([
            'id',
            'created_at',
            'updated_at',
        ])->all();

        $developer = json_encode([[
            'value' => $this->input['developer'],
            'label' => $this->input['developer'],
        ]]);

        $this->dispatchBrowserEvent('developer-lookup-value', $developer);

        $this->showModal = true;
    }

    public function developerLookupSearch($search = '')
    {
        $query = SiteHistory::select(['developer'])
            ->when($search, function ($query) use ($search) {
                return $query->where('developer', 'like', '%' . $search . '%');
            })->oldest('developer')
            ->groupBy('developer');

        $histories = $query->get()->map(function ($history) {
            return [
                'value' => $history['developer'],
                'label' => $history['developer'],
            ];
        });

        $this->dispatchBrowserEvent('developer-lookup-list', $histories);
    }

    public function submit()
    {
        $this->historyId ? $this->update(new UpdateSiteHistory()) : $this->create(new CreateSiteHistory());
    }

    public function create(CreateSiteHistory $action)
    {
        abort_unless(auth()->user()->hasPermissionTo('software-history.create'), 403);

        $action->create($this->input, $this->site);

        $this->emitTo('sites.history.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Software history has been registered.',
        ]);
    }

    public function update(UpdateSiteHistory $action)
    {
        abort_unless(auth()->user()->hasPermissionTo('software-history.update'), 403);

        $action->update($this->input, $this->siteHistory);

        $this->emitTo('sites.history.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Site history has been updated.',
        ]);
    }
}
