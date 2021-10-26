<?php

namespace App\Http\Livewire\VulnerableClients;

use App\Models\VulnerableClient;
use App\Traits\WithColumnSorter;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithColumnSorter;

    public $clientId;

    public $search;

    public $showDelete = false;

    public $showPdf = false;

    protected $listeners = ['render'];

    public function getClientProperty()
    {
        return VulnerableClient::findOrFail($this->clientId);
    }

    public function getPdfUrlProperty()
    {
        if (! $this->clientId) {
            return '';
        }

        return route('reports.vulnerable-clients.pdf', ['vulnerableClient' => $this->client, 'now' => time()]);
    }

    public function render()
    {
        $columns = [
            'name',
            'insurer',
            'policy_number',
            'issued_at',
            'nature',
        ];

        $query = VulnerableClient::when($this->search, function ($query) use ($columns) {
            return $query->where(function ($query) use ($columns) {
                $dateColumns = ['issued_at'];

                $stringColumns = collect($columns)->reject(function ($item) use ($dateColumns) {
                    return in_array($item, $dateColumns);
                })->all();

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

        $query = $this->sortQuery($query, 'created_at');

        $clients = $query->paginate();

        return view('livewire.vulnerable-clients.index', compact('clients'));
    }

    public function updatingSearch()
    {
        $this->resetPage();

        $this->resetSort();
    }

    public function confirmDelete($id)
    {
        abort_unless(auth()->user()->hasPermissionTo('vulnerable-clients.delete'), 403);

        $this->clientId = $id;

        $this->showDelete = true;
    }

    public function delete()
    {
        abort_unless(auth()->user()->hasPermissionTo('vulnerable-clients.delete'), 403);

        $this->client->notes()->delete();

        $this->client->delete();

        $this->showDelete = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Vulnerable client has been deleted.',
        ]);
    }

    public function showPdf($id)
    {
        abort_unless(auth()->user()->hasPermissionTo('vulnerable-clients.view-pdf'), 403);

        $this->clientId = $id;

        $this->showPdf = true;
    }
}
