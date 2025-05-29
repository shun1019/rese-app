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
            'name' => 'required|string|max:191',
            'area' => 'required|string|max:191',
            'genre' => 'required|string|max:191',
            'price'       => 'required|numeric|min:1',
            'description' => 'nullable|string',
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
        ];
    }
}
