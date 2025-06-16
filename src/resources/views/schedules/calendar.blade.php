@extends('layouts.app')

@section('content')
<h1>カレンダー</h1>

<div>
    <button onclick="changeMonth(-1)">← 前の月</button>
    <span id="month-year"></span>
    <button onclick="changeMonth(1)">次の月 →</button>
</div>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th>
        </tr>
    </thead>
    <tbody id="calendar-body">
        <!-- カレンダー本体 -->
    </tbody>
</table>

<div id="editModal" style="display:none; position:fixed; top:20%; left:30%; width:40%; background:white; border:1px solid #ccc; padding:20px; z-index:1000;">
    <h3>予定を編集</h3>
    <form id="editForm">
        <input type="hidden" name="id" id="edit-id">
        <div>
            <label>タイトル:</label>
            <input type="text" id="edit-title" name="title">
        </div>
        <div>
            <label>詳細:</label>
            <input type="text" id="edit-description" name="description">
        </div>
        <div>
            <label>開始日:</label>
            <input type="datetime-local" id="edit-start" name="start">
        </div>
        <div>
            <label>終了日:</label>
            <input type="datetime-local" id="edit-end" name="end">
        </div>
        <button type="submit">保存</button>
        <button type="button" onclick="closeModal()">キャンセル</button>
    </form>
</div>
<div id="modalBackdrop" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.4); z-index:999;" onclick="closeModal()"></div>

@endsection

@push('scripts')
<script src="{{ asset('js/calendar.js') }}"></script>
@endpush