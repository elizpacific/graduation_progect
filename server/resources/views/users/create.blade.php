<x-slot name="title">Created new user</x-slot>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <p>
        <label>First name
            <input type="text" name="firstname" value="{{ old('firstname') }}"><br>
        </label>
    </p>
    <p>
        <label>Last name
            <input type="text" name="lastname" value="{{ old('lastname') }}"><br>
        </label>
    </p>
    <p>
        <label>Username
            <input type="text" name="username" value="{{ old('username') }}"><br>
        </label>
    </p>
    <p>
        <label>Email
            <input type="email" name="email" value="{{ old('email') }}"><br>
        </label>
    </p>
    <p>
        <label>Password
            <input type="password" name="password"/>
        </label>
    </p>
    <p>
        <label>Please repeat password
            <input type="password" name="password_confirmation"/>
        </label>
    </p>
    <button type="submit">Submit</button>
</form>
