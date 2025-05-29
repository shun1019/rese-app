<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string',
            'area'        => 'required|string',
            'genre'       => 'required|string',
            'price'       => 'required|numeric|min:1',
            'description' => 'nullable|string|max:1000',
        ];
    }

    /**
     * カスタムメッセージ
     */
    public function messages(): array
    {
        return [
            'name.required'  => '店舗名を入力してください。',
            'area.required'  => 'エリアを選択してください。',
            'genre.required' => 'ジャンルを選択してください。',
            'price.required' => '料金を入力してください。',
            'price.numeric'  => '料金は数値で入力してください。',
            'price.min'      => '料金は1円以上にしてください。',
        ];
    }
}
