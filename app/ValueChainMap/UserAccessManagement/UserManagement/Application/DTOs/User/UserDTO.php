<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Application\DTOs\User;

use App\ValueChainMap\SharedKernel\Applications\Attribute\MapTo;

final class UserDTO
{
    public function __construct(
        public readonly ?string $user_id,
        
        #[MapTo('email')]
        public readonly ?string $email_address,
        
        #[MapTo('display_name')]
        public readonly ?string $display_name,
        
        #[MapTo('avatar')]
        public readonly ?string $avatar
    ) {}

    public static function fromRequest(array $user_data): self
    {
        return new self(
            user_id: $user_data['user_id'],
            email_address: $user_data['email_address'],
            display_name: $user_data['display_name'],
            avatar: $user_data['avatar']
        );
    }
}