@extends('layouts.app')

@section('content')
    <h1>タスク編集</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tasks.update', [$task->schedule_id, $task->id]) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="schedule_id" value="{{ $task->schedule_id }}">
        <label>タイトル:</label><br>
        <input type="text" name="title" value="{{ old('title', $task->title) }}"><br><br>
        <label>説明:</label><br>
        <input type="description" name="description" value="{{ old('description', $task->description) }}"><br><br>
        <label>期日:</label><br>
        <input type="date" name="due_date" value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') }}"><br><br>
        <label>優先順位:</label><br>
        <select name="priority">
            <option value="">選択してください</option>
            @foreach (range(1, 5) as $i)
                <option value="{{ $i }}" @selected(old('priority', $task->priority) == $i)>{{ $i }}</option>
            @endforeach
        </select><br><br>
        <label>ステータス:</label><br>
        <select name="status">
            <option value="未着手" @selected(old('status', $task->status) == '未着手')>未着手</option>
            <option value="作業中" @selected(old('status', $task->status) == '作業中')>作業中</option>
            <option value="待機" @selected(old('status', $task->status) == '待機')>待機</option>
            <option value="完了" @selected(old('status', $task->status) == '完了')>完了</option>
        </select><br><br>
        <button type="submit">保存</button>
    </form>
    <a href="{{ route('schedules.show', $task->schedule_id) }}">← 戻る</a>
@endsection
