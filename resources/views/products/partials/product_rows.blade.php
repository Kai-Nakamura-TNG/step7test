@foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>
            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="60">
            @else
                なし
            @endif
        </td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->company->company_name }}</td>
        <td>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm text-white">詳細</a>
        </td>
        <td>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="product_delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">削除</button>
            </form>
        </td>
    </tr>
@endforeach
