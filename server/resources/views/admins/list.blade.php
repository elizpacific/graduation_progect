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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>

<head>
    <title>List of admins</title>
</head>

<form action="" method="GET">
    <div class="row">
        <div class="col">
            <label>
                <input name="email" type="text" id="email" class="form-control" placeholder="Email" >
            </label>
        </div>
        <div class="col">
            <label>
                <input name="firstname" type="text" id="firstname" class="form-control" placeholder="Firstname" >
            </label>
        </div>
        <div class="col">
            <label>
                <input name="status" type="text" id="status" class="form-control" placeholder="Status" >
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>

</form>
            <table class="table table-success table-striped">
                <thead>
                <tr>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
            <tbody>

    @foreach($admins as $admin)
        <tr>
            <td>
                <a href="{{ route('admins.admin', $admin) }}">{{ $admin->firstname }}</a>
            </td>
            <td>
                <a>{{ $admin->lastname }}</a>
            </td>
            <td>
                <a>{{ $admin->email }}</a>
            </td>
            <td>
                <a>{{ $admin->status }}</a>
            </td>
        </tr>
    @endforeach
            </tbody>
            </table>
    </div>
</main>
