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

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div>
                @if ($errors->any())
                    <div>
                        <ul class="color-red">
                            @foreach($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                @foreach($products as $product)
                    <div class="input-group mb-3 product-row">
                        <div class="input-group-text">
                            <label for="product_id" class="form-label"></label>
                            <input class="form-check-input mt-0 product-checkbox" type="checkbox" name="product[]" value="{{ $product->id}}">
                        </div>
                        <span class="input-group-text"><b>Product title:</b></span>
                        <span class="input-group-text col-md-4 title">{{ $product->title }}</span>
                        <span class="input-group-text"><b>Product price:</b></span>
                        <span class="input-group-text col-md-2 price" data-price="{{ $product->price }}">{{ $product->price }}</span>
                        <span class="input-group-text"><b>Product quantity:</b></span>
                        <input type="number" aria-label="Product quantity" name="product_quantity[]" class="form-control quantity" value="">
                    </div>
                @endforeach
                <label class="label"></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><b>Total price:</b></span>
                    <span class="input-group-text" id="totalPrice"><b></b></span>
                </div>
                <div class="mb-3">
                    <label for="deliveryAddress" class="form-label"><b>Delivery address:</b></label>
                    <input type="text" class="form-control" id="deliveryAddress" name="delivery_address" value="{{ old('delivery_address') }}">
                </div>
                <div class="mb-3">
                    <label for="user" class="form-label"><b>User:</b></label>
                    <select class="form-select" id="user" name="user_id">
                        <option value="">Choose a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</main>
