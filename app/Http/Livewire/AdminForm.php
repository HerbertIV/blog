<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\AdminDto;
use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\AsyncResource;
use App\Models\Admin;
use App\Services\Contracts\AdminServiceContract;
use App\Services\Contracts\RoleServiceContract;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Mockery\Exception;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AdminForm extends Component
{
    private AdminServiceContract $adminService;
    private RoleServiceContract $roleService;
    public Admin $admin;
    public ?string $name = '';
    public ?string $email = '';
    public ?array $roles = [];
    public string $action;
    public array $button;

    public function __construct($id = null)
    {
        $this->adminService = app(AdminServiceContract::class);
        $this->roleService = app(RoleServiceContract::class);
        parent::__construct($id);
    }

    protected $listeners = [
        'selectedRoles',
        'unselectedRoles',
        'clearRoles',
        'AdminCreateEvent'
    ];

    public function selectedRoles($item)
    {
        $this->roles[] = (int)$item;
    }

    public function unselectedRoles($item)
    {
        if (in_array((int)$item, $this->roles)) {
            unset($this->roles[array_search((int)$item, $this->roles)]);
        }
    }

    public function clearRoles()
    {
        $this->roles = [];
    }

    protected function getRules()
    {
        return array_merge((new AdminRequest())->rules(), [
            'email' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'email',
                'unique:admins,email' . ($this->admin->getKey() ? ',' . $this->admin->getKey() : null)
            ],
        ]);
    }

    public function createAdmin(): void
    {
        $hasCreate = auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('admin' . PermissionEnums::HYPHEN . PermissionEnums::CREATE_ACTION);
        if (!$hasCreate) {
            abort(403);
        }
        $this->resetErrorBag();
        $this->validate();
        $admin = $this->adminService->create(new AdminDto($this->toArray()));
        $this->emit('saved');
        $this->redirect(route('admins.show', $admin));
    }

    public function updateAdmin(): void
    {
        $hasEdit = auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('admin' . PermissionEnums::HYPHEN . PermissionEnums::UPDATE_ACTION);
        if (!$hasEdit) {
            abort(403);
        }
        $this->resetErrorBag();
        $this->validate();
        $admin = $this->admin;
        $adminDto = new AdminDto($this->toArray());
        $this->adminService->update($adminDto, $admin->getKey());
        $this->emit('updated');
        $this->redirect(route('admins.show', $admin));
    }

    public function mount(?Admin $admin = null): void
    {
        if ($admin) {
            $this->admin = $admin;
            $this->setData([
                'name' => $this->admin->name,
                'email' => $this->admin->email,
                'roles' => $this->admin->roles->pluck('id')->toArray(),
            ]);
        }
        $this->button = create_button($this->action, 'Role');
    }

    public function render(): View
    {
        return view('admin.pages.admin.components.admin-form');
    }

    public function getRolesSelect2Format(): ?array
    {
        if ($this->roles) {
            return AsyncResource::collection($this->roleService->get($this->roles))->resolve();
        }
        return null;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles ?? []
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
