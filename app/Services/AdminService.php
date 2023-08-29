<?php

namespace App\Services;

use App\Dtos\AdminDto;
use App\Dtos\ResetPasswordAdminDto;
use App\Events\Templates\Mails\ResetPasswordAdminEvent;
use App\Helpers\StrategyHelper;
use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryContract;
use App\Services\Contracts\AdminServiceContract;
use App\Strategies\Relations\MainRelationStrategy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceContract
{
    public function __construct(
        private AdminRepositoryContract $adminRepository
    ) {
    }

    public function create(AdminDto $adminDto): Admin
    {
        return DB::transaction(function () use ($adminDto) {
            $admin = $this->adminRepository->query()->create([
                ...$adminDto->toArray(),
                ...[
                    'password' => Hash::make(microtime()),
                    'reset_token' => md5(microtime()),
                ]
            ]);
            ResetPasswordAdminEvent::dispatch($admin);
            foreach ($adminDto->getRelations() as $relationKey => $relation) {
                StrategyHelper::makeStrategy(
                    'App\Strategies\Relations\\',
                    $relationKey,
                    MainRelationStrategy::class,
                    'setRelation',
                    [
                        'admin_id' => $admin->getKey(),
                        'roles' => $relation
                    ]
                );
            }
            return $admin;
        });
    }

    public function first(int $id): Admin
    {
        return $this->adminRepository->where(['id' => $id])->first();
    }

    public function deleteMany(array $ids): bool
    {
        return DB::transaction(function () use ($ids) {
            foreach ($ids as $id) {
                $this->delete($id);
            }
            return true;
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(fn () => $this->adminRepository->where(['id' => $id])->delete());
    }

    public function update(AdminDto $adminDto, int $id): bool
    {
        return DB::transaction(function () use ($adminDto, $id) {
            $user = $this->first($id);
            $adminData = $adminDto->toArray();
            $user->fill($adminData);
            $user->save();
            foreach ($adminDto->getRelations() as $relationKey => $relation) {
                StrategyHelper::makeStrategy(
                    'App\Strategies\Relations\\',
                    $relationKey,
                    MainRelationStrategy::class,
                    'setRelation',
                    [
                        'admin_id' => $id,
                        'roles' => $relation
                    ]
                );
            }
            return true;
        });
    }

    public function setRolesToUser(int $adminId, array $roles): void
    {
        $admin = $this->first($adminId);
        if ($admin) {
            DB::transaction(function () use ($roles, $admin) {
                $admin->roles()->sync($roles);
            });
        }
    }

    public function resetPassword(ResetPasswordAdminDto $resetPasswordAdminDto): bool
    {
        return DB::transaction(function () use ($resetPasswordAdminDto) {
            return $this->adminRepository->where(['reset_token' => $resetPasswordAdminDto->getToken()])->update([
                'password' => Hash::make($resetPasswordAdminDto->getPassword()),
                'reset_token' => null
            ]);
        });
    }
}
