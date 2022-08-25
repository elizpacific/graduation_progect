<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request, UserRepository $userRepository): Application|Factory|View
    {
        $users = $this->userRepository->searchBy($request);

        return view('users.list', ['users' => $users]);
    }


    public function getOne($id)
    {
        if (!$user = $this->userRepository->byId($id)) {
            abort(404);
        }
        return view('users.user', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param UserRepository $userRepository
     * @return Application|Factory|View
     */
    public function create(UserRepository $userRepository)
    {
        return view('users.create', ['users' => $userRepository->list()]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        if (!$user = $this->userRepository->byId($id)) {
            abort(404);
        }

        return view('users.user', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            ['firstname' => ['required', 'max:255'],
                'lastname' => ['nullable', 'max:255'],
                'username' => ['required', 'max:255'],
                'email' => ['required', 'max:255'],
                'password' => []]
        );

            $user = $this->userRepository->create($data);
        return redirect(route('users.list', ['id' => $user->id]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application
     */
    public function update(Request $request, int $id)
    {
        if (!$user = $this->userRepository->byId($id)) {
            abort(404);
        }
        return view('users.update', ['user' => $user]);
    }

    public function edit(int $id, Request $request)
    {
        $data = $request->validate(
            ['firstname' => ['required', 'max:255'],
                'lastname' => ['required', 'max:255'],
                'username' => ['required', 'max:255', 'unique:users,username']]
        );

        if (!$user = $this->userRepository->byId($id)) {
            abort(404);
        }

        $user = $this->userRepository->update($user, $data);
        return redirect(route('users.user', ['id' => $user->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Application|RedirectResponse|Redirector
    {
        if (!$user = $this->userRepository->byId($id)) {
            abort(404);
        }
        $this->userRepository->delete($user);

        return redirect(route('users.list'));
    }

}
