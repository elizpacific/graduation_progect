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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <p>
            <label>Title
                <input type="text" name="title" value="{{ old('title') }}"><br>
            </label>
        </p>
        <p>
            <label>Description
                <input type="text" name="description" value="{{ old('description') }}"><br>
            </label>
        </p>
        <p>
            <label>Price
                <input type="text" name="price" value="{{ old('price') }}"><br>
            </label>
        </p>
        <button type="submit">Submit</button>
    </form>
</main>
