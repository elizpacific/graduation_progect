<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository
{
    public function list()
    {
        return User::all();
    }

    public function byId(int $id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        $user = new User;
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->email_verified_token = md5(Carbon::now());
        $user->save();

        return $user;
    }

    public function update(User $user, array $data)
    {
        if (isset($data['firstname'])) {
            $user->firstname = $data['firstname'];
        }
        if (isset($data['lastname'])) {
            $user->lastname = $data['lastname'];
        }
        if (isset($data['username'])) {
            $user->username = $data['username'];
        }

        $user->save();
        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function byEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function byUsername(string $username)
    {
        return User::where('username', $username)->first();
    }

    public function byToken($token)
    {
        return DB::table('users')
            ->select('users.*')
            ->join('user_session_tokens', function (JoinClause  $join) use ($token) {
                $join->on('users.id', '=', 'user_session_tokens.user_id')
                    ->where('user_session_tokens.token', $token);
            })->first();
    }

    public function searchBy(Request $request)
    {
        $users = User::query();
        $request = $request->query->all();

        if(!empty($request['email'])){
            $users->where('email','like',$request['email']);
        }
        if(!empty($request['username'])){
            $users->where('username','like', $request['username'].'%');
        }

        return $users->get();
    }

}
