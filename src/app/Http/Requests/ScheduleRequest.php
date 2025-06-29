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
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return [
            'title' => 'タイトルは必須です。',
            'start_date.required' => '開始日時は必須です',
            'start_date.date' => '開始日時は日時を入力してください。',
            'end_date.required' => '終了日時は必須です',
            'end_date.date' => '終了日時を日時を入力してください。',
            'end_date.after_or_equal' => '終了日時は開始日時より後を入力してください。'
        ];
    }
}