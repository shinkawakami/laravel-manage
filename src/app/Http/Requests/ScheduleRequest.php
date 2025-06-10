<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ];
    }

    public function messages()
    {
        return [
            'title' => 'タイトルは必須です。',
            'start_time.required' => '開始日時は必須です',
            'start_time.date' => '開始日時は日時を入力してください。',
            'end_time.required' => '終了日時は必須です',
            'end_time.date' => '終了日時を日時を入力してください。',
            'end_time.after_or_equal' => '終了日時は開始日時より後を入力してください。'
        ];
    }
}