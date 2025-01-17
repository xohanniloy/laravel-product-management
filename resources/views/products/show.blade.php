<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Add Bootstrap icons for arrow-back functionality -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">Product Details</h4>
        </div>
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-muted mb-0">Product Information</h5>
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="row g-3">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('images') }}/{{ $product->image }}"
                         alt="Product Image"
                         class="img-fluid rounded shadow-sm"
                         style="max-width: 150px;">
                </div>
                <div class="col-md-8">
                    <p><strong>Product ID:</strong> {{ $product->product_id }}</p>
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> ${{ $product->price }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-center py-3">
            <small class="text-muted">Product details are up to date</small>
        </div>
    </div>
</div>




</body>
</html>