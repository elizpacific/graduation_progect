<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserSessionToken;
use Illuminate\Support\Str;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserSessionTokenRepository.
 */
class UserSessionTokenRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function byToken($token)
    {
        return UserSessionToken::where('token', $token)->first();
    }

    public function createOrUpdate(User $user): UserSessionToken
    {
        $userSessionToken = $this->byUserId($user->id) ?? new UserSessionToken();
        $userSessionToken->user_id = $user->id;
        $userSessionToken->token = Str::random(68);
        $userSessionToken->save();

        return $userSessionToken;
    }

    public function byUserId($userId)
    {
        return UserSessionToken::where('user_id',$userId)->first();
    }
}
