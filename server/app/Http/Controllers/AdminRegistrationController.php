<?php

namespace App\Http\Controllers;

use App\Events\EmailVerification;
use App\Repositories\AdminRegistrationRepository;
use Illuminate\Http\Request;

class AdminRegistrationController extends Controller
{
    public AdminRegistrationRepository $adminRegistrationRepository;

    public function __construct(AdminRegistrationRepository $adminRegistrationRepository)
    {
        $this->adminRegistrationRepository = $adminRegistrationRepository;
    }

    public function view()
    {
        return view('admins.registration.view');
    }

    public function post(Request $request)
    {
        $data = $request->validate(
            [
                'firstname' => ['required', 'max:255'],
                'lastname' => ['required', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'max:50'],
                'password_confirmation' => ['required','same:password']
            ]
        );

        $admin = $this->adminRegistrationRepository->post($data);
        EmailVerification::dispatch($admin);

        return redirect(route('admins.admin', ['id' => $admin->id]));
    }

    public function verification(string $token)
    {
        $admin = $this->adminRegistrationRepository->findByVerificationToken($token);
        if ($admin) {
            $this->adminRegistrationRepository->setDateOfVerification($admin);
            return redirect(route('login-page'));
        } else {
            abort(404);
        }
    }
}
