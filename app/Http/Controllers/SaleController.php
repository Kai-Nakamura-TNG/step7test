<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => '商品が見つかりません',
            ], 404);
        }

        if ($product->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => '在庫がありません',
            ], 400);
        }

        try {
            $product->purchase();

            return response()->json([
                'success' => true,
                'message' => '購入しました',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '購入に失敗しました',
            ], 500);
        }
    }
}
