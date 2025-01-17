<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card mt-5 mb-5">
            <div class="card-header text-center"><h4>Add New Product</h4></div>
            <div class="card-body">
                <div class="text-end">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                </div>
                <form method="POST"  action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label class="form-label">product id:</label>
                        <input type="number" name="product_id" class="form-control" value="{{ $product->product_id }}">
                        @error('product_id')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Product Name:</label>
                        <input type="text" name="product_name" class="form-control" value="{{ $product->name }}">
                        @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Product Descrition:</label>
                        <textarea name="product_desc" class="form-control">{{ $product->description }}</textarea>
                        @error('product_desc')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Product Price:</label>
                        <input type="number" name="product_price" class="form-control" value="{{ $product->price }}">
                        @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Product Quantity:</label>
                        <input type="number" name="product_quantity" class="form-control" value="{{ $product->stock }}">
                        @error('product_quantity')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Product Image:</label>
                        <input type="file" name="product_image" class="form-control">
                        @error('product_image')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>