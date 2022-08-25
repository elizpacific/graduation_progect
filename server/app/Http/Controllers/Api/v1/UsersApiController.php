<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UsersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection($this->userRepository->list());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return UserResource
     */
//    public function create(Request $request)
//    {
//        //dd(1);
//        $data = $request->validate(
//            ['firstname' => ['required', 'max:255'],
//                'lastname' => ['required', 'max:255'],
//                'username' => ['required', 'max:255', 'unique:users,username'],
//                'email' => ['required' , 'email', 'unique:users,email'],
//                'password' => ['required' , 'max:255']]
//        );
//        //dd($data);
//        if (!$user = $this->userRepository->create($data)) {
//            abort(404);
//        }
//        return new UserResource($user);
//    }

}
