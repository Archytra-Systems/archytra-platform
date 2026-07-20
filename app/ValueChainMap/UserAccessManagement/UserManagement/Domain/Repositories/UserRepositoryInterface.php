<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Repositories;

use App\ValueChainMap\SharedKernel\Domain\Repository\BaseRepositoryInterface;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface { 
    public function moveUserToTrash(string $user_id): bool;
    public function restoreUserFromTrash(string $user_id): ?User;
    public function deleteUserFromTrash(string $user_id): bool;
}