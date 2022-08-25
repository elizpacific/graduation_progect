<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
//use App\Models\UserSessionToken;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
//use Your Model

/**
 * Class UserRepository.
 */
class AdminRepository
{
    public function list()
    {
        return Admin::all();
    }

    public function byId(int $id)
    {
        return Admin::find($id);
    }

    public function create(array $data)
    {
        $admin = new Admin;
        $admin->firstname = $data['firstname'];
        $admin->lastname = $data['lastname'];
        $admin->password = $data['password'];
        $admin->email = $data['email'];
        $admin->save();

        return $admin;
    }

    /**
     * @param Admin $admin
     * @param array $data
     * @return Admin
     */
    public function update(Admin $admin, array $data)
    {
        if (isset($data['firstname'])) {
            $admin->firstname = $data['firstname'];
        }
        if (isset($data['lastname'])) {
            $admin->lastname = $data['lastname'];
        }
        $admin->save();
        return $admin;
    }

    public function delete(Admin $admin)
    {
        $admin->delete();
    }

    public function searchBy(Request $request)
    {
        $admins = Admin::query();
        $request = $request->query->all();

        if(!empty($request['status'])){
            $admins->where('status','like',$request['status']);
        }
        if(!empty($request['email'])){
            $admins->where('email','like',$request['email']);
        }
        if(!empty($request['firstname'])){
            $admins->where('firstname','like', $request['firstname'].'%');
        }

        return $admins->get();
    }
}
