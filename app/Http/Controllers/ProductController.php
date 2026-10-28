<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search_conditions = $request->only([
            'keyword',
            'company_id',
            'min_price',
            'max_price',
            'min_stock',
            'max_stock',
        ]);
        $products = Product::search($search_conditions)->get();
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    public function store(ProductRequest $request)
    {
        try {
            Product::createWithImage($request->all(), $request->file('img_path'));

            return redirect()->route('products.create');
        } catch (\Exception $e) {
            return redirect()->route('products.create')->with('error', '登録に失敗しました');
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            $product->updateWithImage($request->all(), $request->file('img_path'));

            return redirect()->route('products.edit', $id);
        } catch (\Exception $e) {
            return redirect()->route('products.edit', $id)->with('error', '更新に失敗しました');
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->deleteWithImage();

            return response()->json(['success' => true, 'message' => '削除しました']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' =>'削除に失敗しました'], 500);
        }
    }
}
