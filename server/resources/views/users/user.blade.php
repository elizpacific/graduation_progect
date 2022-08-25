<main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100vh;">
        <span class="fs-4">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
        <a href="{{ route('admins.edit', ['id' => auth()->id()]) }}">Update profile</a>
        <a href="{{ route('logout') }}">Logout</a>
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

<div class="card" style="width: 18rem;">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <b>First name: </b>
            {{ $user->firstname }} </li>
        <li class="list-group-item">
            <b>Last name: </b>
            {{ $user->lastname }} </li>
        <li class="list-group-item">
            <b>Username: </b>
            {{ $user->username }} </li>
        <li class="list-group-item">
            <b>Email: </b>
            {{ $user->email }} </li>
    </ul>
    <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('users.update', $user->id) }}">Update {{$user->username}}</a>
</div>


