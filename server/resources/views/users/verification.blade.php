Please verify email by the <a href ="{{ route('registration.verify', ['token' => urlencode($user->email_verified_token)]) }}">link</a>
