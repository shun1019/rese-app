<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:191',
            'area'        => 'required|string|max:191',
            'genre'       => 'required|string|max:191',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '店舗名を入力してください。',
            'area.required' => 'エリアを選択してください。',
            'genre.required' => 'ジャンルを選択してください。',
        ];
    }
}
