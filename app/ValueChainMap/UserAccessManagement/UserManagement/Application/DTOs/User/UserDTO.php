<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Application\DTOs\User;

use App\ValueChainMap\SharedKernel\Applications\Attribute\MapTo;
use App\ValueChainMap\SharedKernel\Applications\DTOs\BaseDTO;

final class UserDTO extends BaseDTO
{
    public function __construct(
        public readonly ?string $user_id,
        
        #[MapTo('email')]
        public readonly ?string $email_address,
        
        #[MapTo('display_name')]
        public readonly ?string $display_name,

        #[MapTo('password')]
        public readonly ?string $password,
        
        #[MapTo('avatar')]
        public readonly ?string $avatar
    ) {}

    public static function fromRequest(array $user_data): self
    {
        $dto = new self(
            user_id: $user_data['user_id'],
            email_address: $user_data['email_address'],
            display_name: $user_data['display_name'],
            password: $user_data['password'],
            avatar: $user_data['avatar']
        );

        return self::trackKeys($dto, $user_data);
    }
}