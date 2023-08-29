<?php

namespace App\Http\Livewire\Table;

use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use App\Models\User;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Users extends DataTableComponent
{
    private UserServiceContract $userService;
    protected $model = User::class;
    protected $deleteId = null;
    protected $enableModal = false;
    public bool $searchStatus = false;

    protected $listeners = [
        'initModal' => 'initModal'
    ];

    public function __construct($id = null)
    {
        $this->userService = app(UserServiceContract::class);
        parent::__construct($id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        $isEdit = auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('user' . PermissionEnums::HYPHEN . PermissionEnums::UPDATE_ACTION);
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make(__('Email'), 'email')
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => 'View')
                        ->location(fn($row) => route('users.show', ['user' => $row]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                    (
                    $isEdit ?
                        LinkColumn::make('Edit')
                            ->title(fn($row) => 'Edit')
                            ->location(fn($row) => route('users.edit', ['user' => $row]))
                            ->attributes(function ($row) {
                                return [
                                    'target' => '_blank',
                                    'class' => 'underline text-blue-500 hover:no-underline',
                                ];
                            }) :
                        null
                    ),
                ]),
        ];
    }

    public function customView(): string
    {
        return 'admin.components.modal';
    }

    public function initModal($id)
    {
        $this->enableModal = true;
        $this->deleteId = $id;
    }

    public function disableModal()
    {
        $this->enableModal = false;
        $this->deleteId = null;
    }

    public function delete($id)
    {
        if ($this->userService->delete($id)) {
            $this->redirect(route('users.index'));
        }
    }

    public function builder(): Builder
    {
        return User::query()
            ->select([
                'id',
                'email',
            ]);
    }

}
