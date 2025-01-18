<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Product List</h4>
        </div>
        <div class="card-body">

            @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession


            <div class="row mt-4 mb-4">
                <div class="col-md-9">
                    <div class="search-box position-relative">
                    <div class="loader"></div>

                    <i class="bi bi-search"></i><input type="text" id="search" class="form-control" placeholder="Search Product..." data-url="{{ route('products.search') }}"><i class="bi bi-x-square-fill close-icon"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-end">
                    <a href="{{ route('products.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add New Product</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="table-dark">
                    <tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>Image</th>
                    <th>
                        <a href="{{ route('products.index', ['sort' => 'name', 'direction' => request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">Name</a>
                    </th>
                    <th>Description</th>
                    <th>
                        <a href="{{ route('products.index', ['sort' => 'price', 'direction' => request('sort') === 'price' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">Price</a>
                    </th>
                    <th>Stock Quantity</th>
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_id }}</td>
                        <td>
                        <img src="{{ asset('images') }}/{{ $product->image }}" alt="Product Image" class="img-thumbnail" style="width: 50px; height: 50px;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-eye"></i> Show
                        </a>
                        <form class="d-inline" action="{{ route( 'products.destroy', $product->id )}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>

                        </form>

                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>





</body>
</html>