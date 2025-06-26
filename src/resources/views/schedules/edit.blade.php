@extends('layouts.app')

@section('content')
    <h1>予定の編集</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('schedules.update', $schedule) }}">
        @csrf
        @method('PUT')
        
        <label>タイトル:</label><br>
        <input type="text" name="title" value="{{ old('title', $schedule->title) }}"><br><br>

        <label>説明:</label><br>
        <textarea name="description">{{ old('description', $schedule->description) }}</textarea><br><br>

        <label>開始日時:</label><br>
        <input type="datetime-local" name="start_time" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i') }}"><br><br>

        <label>終了日時:</label><br>
        <input type="datetime-local" name="end_time" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i') }}"><br><br>

        <button type="submit">更新</button>
    </form>

    <a href="{{ route('schedules.index') }}">← 戻る</a>
@endsection