<?php

namespace App\Repositories;


use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AdminRegistrationRepository.
 */
class AdminRegistrationRepository
{
    public function post(array $data): Admin
    {
        $admin = new Admin;
        $admin->firstname = $data['firstname'];
        $admin->lastname = $data['lastname'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->status = 'new';
        $admin->email_verified_token = md5(Carbon::now());
        $admin->save();
        return $admin;
    }

    public function findByVerificationToken(string $token): ?Admin
    {
        return Admin::where('email_verified_token', $token)->first();
    }

    public function setDateOfVerification(Admin $admin): Admin
    {
        $admin->email_verified_at = Carbon::now();
        $admin->save();
        return $admin;
    }
}
