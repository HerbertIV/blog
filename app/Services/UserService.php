<?php

namespace App\Services;

use App\Dtos\Blog\RegisterDto;
use App\Dtos\ResetPasswordAdminDto;
use App\Dtos\UserDto;
use App\Events\Templates\Mails\ResetPasswordUserEvent;
use App\Helpers\StrategyHelper;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\UserServiceContract;
use App\Strategies\Relations\MainRelationStrategy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceContract
{
    public function __construct(
        private UserRepositoryContract $userRepository
    ) {
    }

    public function first(int $id): User
    {
        return $this->userRepository->where(['id' => $id])->first();
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
        return DB::transaction(fn () => $this->userRepository->where(['id' => $id])->delete());
    }

    public function update(UserDto $userDto, int $id): bool
    {
        $user = $this->first($id);
        foreach ($userDto->getRelations() as $relationKey => $relation) {
            StrategyHelper::makeStrategy(
                'App\Strategies\Relations\\',
                $relationKey,
                MainRelationStrategy::class,
                'setRelation',
                [
                    'user_id' => $user->getKey(),
                    'roles' => $relation
                ]
            );
        }
        return $user->save();
    }

    public function setRolesToUser(int $userId, array $roles): void
    {
        $user = $this->first($userId);
        if ($user) {
            DB::transaction(function () use ($roles, $user) {
                $user->roles()->sync($roles);
            });
        }
    }

    public function register(RegisterDto $registerDto): bool
    {
        $registerDto->setRoles();
        return DB::transaction(function () use ($registerDto) {
            $user = $this->userRepository->query()->create($registerDto->toArray());
            foreach ($registerDto->getRelations() as $relationKey => $relation) {
                StrategyHelper::makeStrategy(
                    'App\Strategies\Relations\\',
                    $relationKey,
                    MainRelationStrategy::class,
                    'setRelation',
                    [
                        'user_id' => $user->getKey(),
                        'roles' => $relation
                    ]
                );
            }
            return true;
        });

    }

    public function resetPassword(ResetPasswordAdminDto $resetPasswordAdminDto): bool
    {
        return DB::transaction(function () use ($resetPasswordAdminDto) {
            return $this->userRepository->where(['reset_token' => $resetPasswordAdminDto->getToken()])->update([
                'reset_token' => '',
                'password' => Hash::make($resetPasswordAdminDto->getPassword()),
            ]);
        });
    }

    public function resetPasswordStartProcess(string $email): bool
    {
        return DB::transaction(function () use ($email) {
            $user = $this->userRepository->where(['email' => $email])->first();
            $user->reset_token = md5(microtime());
            $user->save();
            ResetPasswordUserEvent::dispatch($user);
            return true;
        });
    }
}
