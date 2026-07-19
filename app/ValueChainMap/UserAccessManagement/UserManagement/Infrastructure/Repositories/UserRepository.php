<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Infrastructure\Repositories;

use App\ValueChainMap\SharedKernel\Infrastructure\Repository\BaseRepository;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Models\User;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    function __construct(User $model) {
        return parent::__construct($model);
    }
}