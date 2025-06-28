<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // 認証済みユーザーだけ許可
    }

    public function rules(): array
    {
        return [
            'schedule_id' => 'required|exists:schedules,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|integer|between:1,5',
            'status' => 'nullable|in:未着手,作業中,待機,完了',
        ];
    }

    public function messages()
    {
        return [
            'schedule_id.*' => 'この予定は存在しないです。',
            'title.required' => 'タイトルは必須です。',
            'title.string' => 'タイトルは文字列で入力してください。',
            'title.max' => 'タイトルは255文字以内で入力してください。',
            'description.string' => '説明は文字列で入力してください。',
            'due_date.date' => '締切日は有効な日付形式で入力してください。',
            'priority.integer' => '優先度は整数で指定してください。',
            'priority.between' => '優先度は1~5の班にで指定してください。',
            'status.required' => 'ステータスは必須です。',
            'status.in' => 'ステータスは「未着手」「作業中」「待機」「完了」のいずれかを指定してください。',
        ];
    }
}