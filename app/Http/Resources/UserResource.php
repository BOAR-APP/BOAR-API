<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array{
     *     id: int,
     *     firstname: string,
     *     lastname: string,
     *     username: string,
     *     email: string,
     *     last_activity: string,
     *     photo_profile: ?string
     * }
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'last_activity' => $this->last_activity,
            'photo_profile' => $this->photo_profile,
        ];
    }
}
