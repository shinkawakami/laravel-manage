@extends('layouts.app')

@section('content')
    <h1>タスク作成</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.store', $schedule_id) }}">
        @csrf
        <input type="hidden" name="schedule_id" value="{{ $schedule_id }}">
        <input type="hidden" name="status_code" value="{{ \App\Models\Task::STATUS_UNSTARTED }}">
        <label>タイトル:</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br><br>
        <label>説明:</label><br>
        <textarea name="description">{{ old('description') }}</textarea><br><br>
        <label>期日:</label><br>
        <input type="date" name="due_date" value="{{ old('due_date') }}"><br><br>
        <label>優先順位:</label><br>
        <select name="priority">
            <option value="">選択してください</option>
            @foreach (range(1, 5) as $i)
                <option value="{{ $i }}" @selected(old('priority') == $i)>{{ $i }}</option>
            @endforeach
        </select><br><br>
        <button type="submit">保存</button>
    </form>
    <a href="{{ route('schedules.show', $schedule_id) }}">← 戻る</a>
@endsection