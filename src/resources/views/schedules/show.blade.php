@extends('layouts.app')

@section('content')
    <h1>予定詳細</h1>

    <h3>{{ $schedule->title }}</h3>
    <p>{{ $schedule->description }}</p>
    <p>期間：{{ $schedule->start_time . '~' . $schedule->end_time}}</p>
    <a href="{{ route('tasks.create', $schedule->id) }}">タスク新規作成</a><br>
    <ul>
        @foreach($schedule->tasks as $task)
            <li>
                @if($task->status == '完了')
                    <p>済</p>
                @endif
                <a href="{{ route('tasks.edit', [$schedule->id, $task->id]) }}">{{ $task->title }}</a>
                <p>{{ $task->description }}</p>
                <p>{{ $task->due_date }}</p>
                <p>{{ $task->status }}</p>
                @if($task->priority)
                    <p>{{ $task->priority }}</p>
                @endif
                <form method="POST" action="{{ route('tasks.destroy', [$schedule->id, $task->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
                <br>
                <hr>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('schedules.index') }}">← 戻る</a>
@endsection