<main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100vh;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <a href="{{ route('users.list') }}" class="nav-link text-white">Users</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admins.list')}}" class="nav-link text-white">Admins</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('orders.list') }}" class="nav-link text-white">Orders</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.list') }}" class="nav-link text-white">Products</a>
            </li>
        </ul>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
<x-registration-auth-layout>
    <x-slot name="title">Registration</x-slot>

    <form action="{{ route('register') }}" method="POST">
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
            <label>Email
                <input type="text" name="email" value="{{ old('email') }}"><br>
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
</x-registration-auth-layout>
</main>
