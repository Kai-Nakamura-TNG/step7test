@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">商品詳細</h1>

    <div class="row g-2 mb-3">
        <label class="col-2 col-form-label">商品ID</label>
        <div class="col-6 col-form-label">{{ $product->id }}</div>
    </div>

    <div class="row g-2 mb-3 align-items-center">
        <label class="col-2 col-form-label">商品画像</label>
        <div class="col-6">
            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="100">
            @else
                なし
            @endif
        </div>
    </div>

    <div class="row g-2 mb-3">
        <label class="col-2 col-form-label">商品名</label>
        <div class="col-6 col-form-label">{{ $product->product_name }}</div>
    </div>

    <div class="row g-2 mb-3">
        <label class="col-2 col-form-label">メーカー</label>
        <div class="col-6 col-form-label">{{ $product->company->company_name }}</div>
    </div>

    <div class="row g-2 mb-3">
        <label class="col-2 col-form-label">価格</label>
        <div class="col-6 col-form-label">¥{{ $product->price }}</div>
    </div>

    <div class="row g-2 mb-3">
        <label class="col-2 col-form-label">在庫数</label>
        <div class="col-6 col-form-label">{{ $product->stock }}</div>
    </div>

    <div class="row g-2 mb-3">
        <label class="col-2 col-form-label">コメント</label>
        <div class="col-6 col-form-label">{{ $product->comment }}</div>
    </div>

    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">編集</a>
    <a href="{{ route('products.index') }}" class="btn btn-info">戻る</a>
</div>
@endsection
