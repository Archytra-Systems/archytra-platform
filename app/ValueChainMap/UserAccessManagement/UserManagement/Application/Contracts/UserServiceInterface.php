<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Application\Contracts\UserService;

use App\ValueChainMap\UserAccessManagement\UserManagement\Application\DTOs\User\UserDTO;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Models\User;


interface UserServiceInterface
{
    public function registerUser(UserDTO $user_data_object): User;
}