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
        return [
            'date' => 'required|date',
            'time' => 'required',
            'number' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => '日付を入力してください。',
            'date.date' => '有効な日付を入力してください。',
            'time.required' => '時間を選択してください。',
            'number.required' => '人数を入力してください。',
        ];
    }
}
