<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // 認証済みユーザーだけ許可
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'content' => 'nullable|max:2000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.max' => 'タイトルは100文字までです。',
            'content.max' => 'メモは2000文字までです。',
        ];
    }
}