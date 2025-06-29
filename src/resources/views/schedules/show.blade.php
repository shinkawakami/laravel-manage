@extends('layouts.app')

@section('content')
    <h1>予定詳細</h1>

    <h3>{{ $schedule->title }}</h3>
    <p>{{ $schedule->description }}</p>
    <p>期間：{{ $schedule->start_date . '~' . $schedule->end_date}}</p>
    <a href="{{ route('tasks.create', $schedule->id) }}">タスク新規作成</a><br>
    <ul>
        @foreach($schedule->tasks as $task)
            <li>
                <a href="{{ route('tasks.edit', [$schedule->id, $task->id]) }}">{{ $task->title }}</a>
                @if( $task->status_code === \App\Models\Task::STATUS_DONE )
                    <span>済</span>
                @endif
                <p>詳細：{{ $task->description }}</p>
                @if($task->due_date)
                    <span>期日：{{ $task->due_date }}</span>
                @endif
                <span>ステータス：{{ $task->status_label }}</span>
                @if($task->priority)
                    <span>優先順位：{{ $task->priority }}</span>
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