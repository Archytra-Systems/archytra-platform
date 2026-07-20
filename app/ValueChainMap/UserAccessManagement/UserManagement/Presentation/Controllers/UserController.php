<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\ValueChainMap\UserAccessManagement\UserManagement\Application\Contracts\UserServiceInterface;
use App\ValueChainMap\UserAccessManagement\UserManagement\Application\DTOs\User\UserDTO;
use App\ValueChainMap\UserAccessManagement\UserManagement\Presentation\Requests\Users\RegisterUserRequest;
use App\ValueChainMap\UserAccessManagement\UserManagement\Presentation\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    function __construct(
        private readonly UserServiceInterface $user_service
    ) {}

    public function registerUser(RegisterUserRequest $request): JsonResponse {

        $validated_data = $request->validated();
        $user_data = UserDTO::fromRequest($validated_data);

        $user = $this->user_service->registerUser($user_data);

        return response()->json([
            'success' => true,
            'message' => 'Welcome to the community! Your account is ready.',
            'data' => new UserResource($user)
        ], 201);
    }
}
