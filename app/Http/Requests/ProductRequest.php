<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_id' => 'メーカー',
            'price' => '価格',
            'stock' => '在庫数',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => ':attributeを入力してください。',
            'company_id.required' => ':attributeを選択してください。',
            'price.required' => ':attributeを入力してください。',
            'price.numeric' => ':attributeは数字で入力してください。',
            'stock.required' => ':attributeを入力してください。',
            'stock.numeric' => ':attributeは数字で入力してください。',
        ];
    }
}
