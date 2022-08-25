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

    </head>

    <form action="{{ route('orders.statistic') }}" method="GET">
        <div class="input-group mb-3 product-row">
            <span class="input-group-text"><b>Enter date from:</b></span>
            <input type="date" aria-label="Date from" name="from" class="form-control" value="{{ $dateFrom ?? null }}">
        </div>
        <div class="input-group mb-3 product-row">
            <span class="input-group-text"><b>Enter date to:</b></span>
            <input type="date" aria-label="Date to" name="to" class="form-control" value="{{ $dateTo ?? null }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>

    </form>
    <div class="container">
        <x-slot name="title">Order statistics</x-slot>
        <div class="input-group mb-3">
            <span class="input-group-text"><b>Amount of orders:</b></span>
            <span class="input-group-text" id="amount"><b>{{ $amountOfOrders}}</b></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text"><b>Total price:</b></span>
            <span class="input-group-text" id="totalPrice"><b>{{ $totalPrice}}</b></span>
        </div>
    </div>

</main>
