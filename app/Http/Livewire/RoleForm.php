<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\RoleDto;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\AsyncResource;
use App\Services\Contracts\PermissionServiceContract;
use App\Services\Contracts\RoleServiceContract;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleForm extends Component
{
    private RoleServiceContract $roleService;
    private PermissionServiceContract $permissionService;
    public ?string $name = '';
    public ?array $permissions = [];
    public Role $role;
    public string $action;
    public array $button;

    public function __construct($id = null)
    {
        $this->roleService = app(RoleServiceContract::class);
        $this->permissionService = app(PermissionServiceContract::class);
        parent::__construct($id);
    }

    protected $listeners = [
        'selectedPermissions',
        'unselectedPermissions',
        'clearPermissions',
        'RoleCreateEvent'
    ];

    public function selectedPermissions($item)
    {
        $this->permissions[] = (int)$item;
    }

    public function unselectedPermissions($item)
    {
        if (in_array((int)$item, $this->permissions)) {
            unset($this->permissions[array_search((int)$item, $this->permissions)]);
        }
    }

    public function clearPermissions()
    {
        $this->permissions = [];
    }

    protected function getRules()
    {
        return (new RoleRequest())->rules();
    }

    public function createRole(): void
    {

        $this->resetErrorBag();
        $this->validate();

        $roleDto = new RoleDto($this->toArray());
        $role = $this->roleService->create($roleDto);

        $this->emit('saved');
        $this->redirect(route('roles.show', $role));
    }

    public function updateRole(): void
    {
        $this->resetErrorBag();
        $this->validate();
        $role = $this->role;
        $roleDto = new RoleDto($this->toArray());
        $this->roleService->update($roleDto, $role->getKey());
        $this->emit('updated');
        $this->redirect(route('roles.show', $role));
    }

    public function mount(?Role $role = null): void
    {
        if ($role) {
            $this->role = $role;
            $this->setData([
                'name' => $this->role->name,
                'permissions' => $this->role->permissions->pluck('id')->toArray(),
            ]);
        }
        $this->button = create_button($this->action, 'Role');
    }

    public function render(): View
    {
        return view('admin.pages.role.components.role-form');
    }

    public function getPermissionsSelect2Format(): ?array
    {
        if ($this->permissions) {
            return AsyncResource::collection($this->permissionService->get($this->permissions))->resolve();
        }
        return null;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'permissions' => $this->permissions ?? []
        ];
    }

    public function setData(array $data): void
    {
        foreach ($data as $k => $v) {
            $key = Str::studly($k);
            if (method_exists($this, 'set' . $key)) {
                $this->{'set' . $key}($v);
            } else {
                $key = lcfirst($key);
                if (array_key_exists($key, get_class_vars(self::class))) {
                    $this->$key = $v;
                }
            }
        }
    }
}
