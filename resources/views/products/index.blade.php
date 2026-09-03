@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">商品一覧</h1>

    <form action="{{ route('products.index') }}" method="GET" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索" class="form-control">
        </div>
        <div class="col-auto">
            <select name="company_id" class="form-select">
                <option value="">すべてのメーカー</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-info text-white">検索</button>
        </div>
    </form>

    <a href="{{ route('products.create') }}" class="btn btn-warning mb-3">新規登録</a>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
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
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
