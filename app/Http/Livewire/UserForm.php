<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\UserDto;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\AsyncResource;
use App\Models\User;
use App\Services\Contracts\RoleServiceContract;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class UserForm extends Component
{
    private RoleServiceContract $roleService;
    private UserServiceContract $userService;
    public ?array $roles = [];
    public User $user;
    public string $action;
    public array $button;

    public function __construct($id = null)
    {
        $this->roleService = app(RoleServiceContract::class);
        $this->userService = app(UserServiceContract::class);
        parent::__construct($id);
    }

    protected $listeners = [
        'selectedRoles',
        'unselectedRoles',
        'clearRoles'
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
        return (new UserRequest())->rules();
    }

    public function mount(?User $user = null): void
    {
        if ($user) {
            $this->user = $user;
            $this->setData([
                'roles' => $this->user->roles ? $this->user->roles->pluck('id')->toArray() : [],
            ]);
        }
        $this->button = create_button($this->action, 'User');
    }

    public function updateUser(): void
    {
        $this->resetErrorBag();
        $this->validate();

        $user = $this->user;
        $userDto = new UserDto($this->toArray());
        $this->userService->update($userDto, $user->getKey());

        $this->emit('updated');
        $this->redirect(route('users.show', $user));
    }

    public function render(): View
    {
        return view('admin.pages.user.components.user-form');
    }

    public function getRolesSelect2Format(): ?array
    {
        if ($this->roles) {
            return AsyncResource::collection($this->roleService->get($this->roles))->resolve();
        }
        return [];
    }

    public function toArray(): array
    {
        return [
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
