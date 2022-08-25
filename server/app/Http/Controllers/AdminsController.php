<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request, AdminRepository $adminRepository): Application|Factory|View
    {
        $admins = $this->adminRepository->searchBy($request);

        return view('admins.list', ['admins' => $admins]);
    }

    public function getOne($id)
    {
        if (!$admin = $this->adminRepository->byId($id)) {
            abort(404);
        }
        return view('admins.admin', ['admin' => $admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param AdminRepository $adminRepository
     * @return Application|Factory|View
     */
    public function create(AdminRepository $adminRepository): Application|Factory|View
    {
        return view('admins.create', ['admins' => $adminRepository->list()]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        if (!$admin = $this->adminRepository->byId($id)) {
            abort(404);
        }

        return view('admins.admin', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector|Application
     */
    public function update(Request $request, int $id)
    {
        if (!$admin = $this->adminRepository->byId($id)) {
            abort(404);
        }
        return view('admins.update', ['admin' => $admin]);
    }

    public function edit($id, Request $request)
    {
        $data = $request->validate(
            ['firstname' => ['required', 'max:255'],
                'lastname' => ['required', 'max:255']]
        );

        if (!$admin = $this->adminRepository->byId($id)) {
            abort(404);
        }

        $admin = $this->adminRepository->update($admin, $data);
        //AdminUpdate::dispatch($admin);
        return redirect(route('admins.admin', ['id' => $admin->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Application|RedirectResponse|Redirector
    {
        if (!$admin = $this->adminRepository->byId($id)) {
            abort(404);
        }
        $this->adminRepository->delete($admin);

        return redirect(route('admins.list'));
    }
}
