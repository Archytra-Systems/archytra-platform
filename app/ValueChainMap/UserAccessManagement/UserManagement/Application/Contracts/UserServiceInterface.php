<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Application\Contracts;

use App\ValueChainMap\UserAccessManagement\UserManagement\Application\DTOs\User\UserDTO;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Models\User;


interface UserServiceInterface
{

    public function registerUser(UserDTO $user_data_object): User;
    public function updateUser(string $user_id, UserDTO $user_data_object): User;
    public function moveUserToTrash(string $user_id): bool;
    public function restoreUserFromTrash(string $user_id): User;
    public function deleteUserFromTrash(string $user_id): bool;

}