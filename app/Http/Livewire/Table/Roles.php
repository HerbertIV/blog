<?php

namespace App\Http\Livewire\Table;

use App\Services\Contracts\RoleServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Spatie\Permission\Models\Role;

class Roles extends DataTableComponent
{
    private RoleServiceContract $roleService;
    protected $model = Role::class;
    protected $modal = false;
    protected $delete = false;


    public function __construct($id = null)
    {
        $this->roleService = app(RoleServiceContract::class);
        parent::__construct($id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make(__('Name'), 'name')
                ->sortable(),
            Column::make(__('Created At'), 'created_at')
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
                        ->location(fn($row) => route('roles.show', ['role' => $row]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('roles.edit', ['role' => $row]))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => 'Delete')
                        ->location(fn($row) => route('roles.delete', ['role' => $row]))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'underline text-blue-500 hover:no-underline',
                                'data-delete' => true,
                                'wire:click' => 'delete('.$row->getKey().')'
                            ];
                        }),
                ]),
        ];
    }

    public function delete($id)
    {
        if ($this->roleService->delete($id)) {
            $this->redirect(route('roles.index'));
        }
    }

    public function builder(): Builder
    {
        return Role::query()->select([
            'id',
            'name',
            'created_at',
        ]);
    }

}
