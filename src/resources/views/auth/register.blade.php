@extends('layouts.guest')

@section('title', '新規登録 | アプリ名')
@section('meta')
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
    <h1>新規登録</h1>

    <form id="registerForm" class="js-submit-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">名前</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                required
                autocomplete="name"
                inputmode="text"
                @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
            >
            @error('name')
                <p id="name-error" class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                inputmode="email"
                spellcheck="false"
                @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
            >
            @error('email')
                <p id="email-error" class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">パスワード</label>
            <div class="input-wrapper @error('password') is-invalid @enderror">
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    minlength="8"
                    @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
                >
                <button
                    type="button"
                    class="toggle-btn js-password-toggle"
                    aria-label="パスワードを表示"
                    aria-pressed="false"
                    aria-controls="password"
                    data-target="password"
                >👁</button>
            </div>
            @error('password')
                <p id="password-error" class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">パスワード確認</label>
            <div class="input-wrapper">
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    minlength="8"
                >
                <button
                    type="button"
                    class="toggle-btn js-password-toggle"
                    aria-label="パスワードを表示"
                    aria-pressed="false"
                    aria-controls="password_confirmation"
                    data-target="password_confirmation"
                >👁</button>
            </div>
        </div>

        <button type="submit" id="registerSubmit" class="form-button js-submit-btn">
            登録
        </button>
    </form>

    <p>
        すでにアカウントをお持ちですか？
        <a href="{{ route('login') }}">ログイン</a>
    </p>
@endsection

@push('styles')
    @vite(['resources/css/register.css'])
@endpush
