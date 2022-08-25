<?php

namespace App\Http\Resources;

use App\Repositories\UserRepository;
use App\Repositories\UserSessionTokenRepository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'token' => $this->userSessionTokenRepository()->byUserId($this->id)->token,
        ];
    }

    private function userSessionTokenRepository(): UserSessionTokenRepository
    {
        return app(UserSessionTokenRepository::class);
    }
}
