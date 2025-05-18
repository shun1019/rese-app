<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'shop_id' => 'required|exists:shops,id',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required|date_format:H:i',
                'number' => 'required|integer|min:1|max:10',
            ];
        }

        return [
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'number' => 'required|integer|min:1|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'shop_id.required' => '店舗情報がありません。',
            'shop_id.exists' => '無効な店舗が選択されています。',
            'date.required' => '日付を入力してください。',
            'date.date' => '有効な日付を入力してください。',
            'date.after_or_equal' => '今日以降の日付を選択してください。',
            'time.required' => '時間を選択してください。',
            'time.date_format' => '時間の形式が正しくありません。',
            'number.required' => '人数を入力してください。',
            'number.integer' => '人数は数字で入力してください。',
            'number.min' => '1人以上で入力してください。',
            'number.max' => '10人以内で入力してください。',
        ];
    }
}