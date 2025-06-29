@extends('layouts.app')

@section('content')
    <h1>予定の新規作成</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('schedules.store') }}">
        @csrf

        <label>タイトル:</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br><br>

        <label>説明:</label><br>
        <textarea name="description">{{ old('description') }}</textarea><br><br>

        <label>開始日時:</label><br>
        <input type="date" name="start_date" value="{{ old('start_date') }}"><br><br>

        <label>終了日時:</label><br>
        <input type="date" name="end_date" value="{{ old('end_date') }}"><br><br>

        <button type="submit">保存</button>
    </form>

    <a href="{{ route('schedules.index') }}">← 戻る</a>
@endsection