<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Application\Services;

use App\ValueChainMap\SharedKernel\Infrastructure\Mapper\DataMapper;
use App\ValueChainMap\UserAccessManagement\UserManagement\Application\Contracts\UserServiceInterface;
use App\ValueChainMap\UserAccessManagement\UserManagement\Application\DTOs\User\UserDTO;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Models\User;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

final class UserService implements UserServiceInterface
{
    function __construct(
        private readonly UserRepositoryInterface $user_repository
    ) { }

    public function registerUser(UserDTO $user_data_object): User {

        $user_data = DataMapper::toDatabase($user_data_object, ['user_id']);
        $user_data['password'] = Hash::make($user_data_object->password);
        $user = $this->user_repository->create($user_data);

        if ( !$user ) {
            // Return 422 Unprocessable Entity if the user could not be created
            throw new UnprocessableEntityHttpException("We couldn't create your account. Please verify your details and try again.");
        }
        
        return $user;
        
    }

    public function updateUser(string $user_id, UserDTO $user_data_object): User {
        $user = $this->user_repository->update($user_id, DataMapper::toDatabase($user_data_object, ['user_id']));

        if ( !$user ) {
            // Return 422 Unprocessable Entity if the user could not be updated
            throw new UnprocessableEntityHttpException("We couldn't update your account. Please verify your details and try again.");
        }

        return $user;
    }

    public function moveUserToTrash(string $user_id): bool {
        $user = $this->user_repository->moveUserToTrash($user_id);
        
        if ( !$user ) {
            // Return 422 Unprocessable Entity if the user could not be moved to trash
            throw new UnprocessableEntityHttpException("We couldn't move your account to trash. Please verify your details and try again.");
        }

        return $user;
    }

    public function restoreUserFromTrash(string $user_id): User {
        $user = $this->user_repository->restoreUserFromTrash($user_id);

        if ( !$user ) {
            // Return 422 Unprocessable Entity if the user could not be restored
            throw new UnprocessableEntityHttpException("We couldn't restore your account. Please verify your details and try again.");
        }

        return $user;
    }

    public function deleteUserFromTrash(string $user_id): bool {
        $deleted = $this->user_repository->deleteUserFromTrash($user_id);

        if ( !$deleted ) {
            // Return 422 Unprocessable Entity if the user could not be deleted
            throw new UnprocessableEntityHttpException("We couldn't delete your account. Please verify your details and try again.");
        }

        return $deleted;
    }
}