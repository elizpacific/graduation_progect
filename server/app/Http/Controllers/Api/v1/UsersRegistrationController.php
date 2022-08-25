<?php
namespace App\Http\Controllers\Api\v1;
use App\Events\UserEmailVerification;
use App\Http\Resources\UserResource;
use App\Repositories\UserRegistrationRepository;
use Illuminate\Http\Request;

class UsersRegistrationController
{
    public UserRegistrationRepository $registrationRepository;

    public function __construct(UserRegistrationRepository $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }
    public function post(Request $request): UserResource
    {
        $data = $request->validate([
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ]);
        $user = $this->registrationRepository->post($data);
        UserEmailVerification::dispatch($user);
        return new UserResource($user);
    }
    public function verification(string $token)
    {
        $user = $this->registrationRepository->findByVerificationToken($token);
        if ($user) {
            $this->registrationRepository->setDateOfVerification($user);
            return redirect('http://localhost:5173/login');
        } else {
            abort(404);
        }
    }
}
