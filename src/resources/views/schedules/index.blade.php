@extends('layouts.app')

@section('content')
    <h1>予定一覧</h1>

    <a href="{{ route('schedules.create') }}">＋ 新規作成</a>

    <ul>
        @foreach ($schedules as $schedule)
            <li>
                <strong>{{ $schedule->title }}</strong><br>
                {{ $schedule->start_time }} 〜 {{ $schedule->end_time }}<br>
                {{ $schedule->description }}

                <div style="margin-top: 5px;">
                    <a href="{{ route('schedules.edit', $schedule) }}">編集</a>
                    <form method="POST" action="{{ route('schedules.destroy', $schedule) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </div>
                <hr>
            </li>
        @endforeach
    </ul>
@endsection