@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">商品一覧</h1>

    <form action="{{ route('products.index') }}" method="GET" class="row g-2 mb-3 product_search-form">
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
            <input type="number" name="min_price" value="{{ request('min_price') }}" min="0" placeholder="価格(下限)" class="form-control">
        </div>
        <div class="col-auto">
            <input type="number" name="max_price" value="{{ request('max_price') }}" min="0" placeholder="価格(上限)" class="form-control">
        </div>
        <div class="col-auto">
            <input type="number" name="min_stock" value="{{ request('min_stock') }}" min="0" placeholder="在庫数(下限)" class="form-control">
        </div>
        <div class="col-auto">
            <input type="number" name="max_stock" value="{{ request('max_stock') }}" min="0" placeholder="在庫数(上限)" class="form-control">
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
        <tbody id="productTableBody">
            @include('products.partials.product_rows')
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/product.js') }}"></script>
@endpush
