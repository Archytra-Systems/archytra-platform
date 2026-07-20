<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'email_address' => $this->email,
            'full_name' => $this->display_name,
            'avatar' => $this->avatar
        ];
    }
}
