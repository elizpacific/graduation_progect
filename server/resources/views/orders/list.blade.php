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

    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Owner</th>
                <th>Title</th>
                <th>Amount of product</th>
                <th>Total price</th>
                <th>Delivery address</th>
                <th>Status</th>
                <th>Date of create</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->firstname }} {{ $order->user->lastname }}</td>
                    <td>
                    @foreach($order->product as $product)
                            <div>{{ $product->title }}</div>
                        @endforeach
                    </td>
                    <td>
                    @foreach($order->orderProduct as $orderProduct)
                    <div>{{ $orderProduct->product_number}}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($order->orderProduct as $orderProduct)
                            <div>{{ $orderProduct->total_price}}</div>
                        @endforeach
                    </td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <a href="{{ route('orders.create') }}">Create new order</a>
        </div>
    </div>
</main>
