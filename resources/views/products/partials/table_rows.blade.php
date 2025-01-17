@foreach($products as $product)
<tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->product_id }}</td>
    <td>
        <img src="{{ $product->image }}" alt="Product Image" class="img-thumbnail" style="width: 50px; height: 50px;">
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
        <form class="d-inline" action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method("DELETE")
            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
        </form>
    </td>
</tr>
@endforeach
