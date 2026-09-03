@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">商品編集</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-2 mb-3 align-items-center">
            <div class="col-2">
                <label class="col-form-label">商品名<span class="text-danger">*</span></label>
            </div>
            <div class="col-6">
                <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control">
                @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-2 mb-3 align-items-center">
            <div class="col-2">
                <label class="col-form-label">メーカー名<span class="text-danger">*</span></label>
            </div>
            <div class="col-6">
                <select name="company_id" class="form-select">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                    @endforeach
                </select>
                @error('company_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-2 mb-3 align-items-center">
            <div class="col-2">
                <label class="col-form-label">価格<span class="text-danger">*</span></label>
            </div>
            <div class="col-6">
                <input type="text" name="price" value="{{ $product->price }}" class="form-control">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-2 mb-3 align-items-center">
            <div class="col-2">
                <label class="col-form-label">在庫数<span class="text-danger">*</span></label>
            </div>
            <div class="col-6">
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control">
                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-2 mb-3 align-items-center">
            <div class="col-2">
                <label class="col-form-label">コメント</label>
            </div>
            <div class="col-6">
                <textarea name="comment" class="form-control">{{ $product->comment }}</textarea>
            </div>
        </div>

        <div class="row g-2 mb-3 align-items-center">
            <div class="col-2">
                <label class="col-form-label">商品画像</label>
            </div>
            <div class="col-6">
                <input type="file" name="img_path" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-warning">更新</button>
        <a href="{{ route('products.index') }}" class="btn btn-info">戻る</a>
    </form>
</div>
@endsection
