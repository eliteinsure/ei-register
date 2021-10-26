<?php

namespace App\Http\Livewire\Users;

use App\Actions\User\CreateUser;
use App\Actions\User\UpdateUser;
use App\Models\User;
use App\Traits\Validators\FocusError;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    use FocusError;

    public $userId;

    public $input;

    public $permissionToggle;

    public $showModal = false;

    public $roles;

    protected $listeners = ['add', 'edit'];

    public function getTitleProperty()
    {
        if ($this->userId) {
            return auth()->user()->hasRole('admin') ? 'Update User' : 'User Detials';
        } else {
            return 'Register a User';
        }
    }

    public function getUserProperty()
    {
        return User::where('id', $this->userId)->where('id', '!=', auth()->user()->id)->firstOrFail();
    }

    public function mount()
    {
        $this->resetInput();

        $this->roles = collect(config('services.roles'))->map(function ($role) {
            return [
                'value' => $role,
                'label' => Str::title($role),
            ];
        })->all();
    }

    public function render()
    {
        return view('livewire.users.form');
    }

    public function resetInput()
    {
        $this->input = [
            'permissions' => [],
        ];

        $this->permissionToggle = null;
    }

    public function add()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->userId = null;

        $this->resetInput();

        $this->showModal = true;
    }

    public function edit($id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->userId = $id;

        $this->input = collect($this->user)->only(['name', 'email'])->all();

        $this->input['permissions'] = $this->user->getPermissionNames()->all();

        $this->permissionToggle = null;

        $this->showModal = true;
    }

    public function updatedPermissionToggle($value)
    {
        if ($value) {
            foreach (config('services.permissions') as $parentPermissionName => $parentPermission) {
                $this->input['permissions'][] = $parentPermissionName;

                foreach ($parentPermission as $childPermissionName => $childPermission) {
                    $this->input['permissions'][] = $parentPermissionName . '.' . $childPermissionName;
                }
            }
        } else {
            $this->input['permissions'] = [];
        }
    }

    public function updatePermissions($value)
    {
        if (in_array($value, $this->input['permissions'])) {
            foreach (config('services.permissions.' . $value) as $name => $title) {
                $this->input['permissions'][] = $value . '.' . $name;
            }
        } else {
            $permissions = collect($this->input['permissions'])->filter(function ($item) use ($value) {
                return ! Str::startsWith($item, $value . '.');
            })->values()->all();

            $this->input['permissions'] = $permissions;
        }
    }

    public function dehydrate()
    {
        $this->focusError();
    }

    public function submit()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $this->userId ? $this->update(new UpdateUser()) : $this->create(new CreateUser());
    }

    public function create(CreateUser $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->create($this->input);

        $this->emitTo('users.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'User has been registered.',
        ]);
    }

    public function update(UpdateUser $action)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $action->update($this->input, $this->user);

        $this->emitTo('users.index', 'render');

        $this->showModal = false;

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'User has been updated.',
        ]);
    }
}
