<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'area' => 'required|string',
            'genre' => 'required|string',
            'price'       => 'required|numeric|min:1',
            'description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '店舗名は必須です。',
            'area.required' => 'エリアは必須です。',
            'genre.required' => 'ジャンルは必須です。',
            'price.required' => '料金を入力してください。',
            'price.numeric'  => '料金は数値で入力してください。',
            'price.min'      => '料金は1円以上にしてください。',
            'description.required' => '説明を入力してください。',
        ];
    }
}
