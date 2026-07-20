<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Infrastructure\Repositories;

use App\ValueChainMap\SharedKernel\Infrastructure\Repository\BaseRepository;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Models\User;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    function __construct(User $model) {
        parent::__construct($model);
    }

    public function moveUserToTrash(string $user_id): bool {
        $user = $this->model->whereKey($user_id)->first();
        
        if ( !$user ) {
            return false;
        }

        return $user->delete();
    }

    public function restoreUserFromTrash(string $user_id): ?User {
        $user = $this->model->withTrashed()->whereKey($user_id)->first();
        
        if ( !$user ) {
            return null;
        }
        
        return $user->restore() ? $user : null;
    }

    public function deleteUserFromTrash(string $user_id): bool {
        $user = $this->model->withTrashed()->whereKey($user_id)->first();
        
        if ( !$user ) {
            return false;
        }

        return $user->forceDelete();
    }
}