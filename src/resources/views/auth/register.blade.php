@extends('layouts.guest')

@section('title', '新規登録 | アプリ名')
@section('meta')
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
    <h1>新規登録</h1>

    <form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        {{-- 名前 --}}
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
                <p id="name-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- メールアドレス --}}
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
                <p id="email-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- パスワード --}}
        <div>
            <label for="password">パスワード</label>
            <div>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    minlength="8"
                    @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
                >
                <button type="button" id="togglePassword">表示</button>
            </div>
            @error('password')
                <p id="password-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- パスワード確認 --}}
        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                minlength="8"
                @error('password_confirmation') aria-invalid="true" aria-describedby="password_confirmation-error" @enderror
            >
            @error('password_confirmation')
                <p id="password_confirmation-error">{{ $message }}</p>
            @enderror
        </div>

        <button id="registerSubmit" type="submit">
            登録
        </button>
    </form>

    <p>
        すでにアカウントをお持ちですか？
        <a href="{{ route('login') }}">ログイン</a>
    </p>

    {{-- 総合エラー --}}
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('registerSubmit');
    const toggle = document.getElementById('togglePassword');
    const pwd = document.getElementById('password');

    // 多重送信対策
    form.addEventListener('submit', () => {
        if (!form.checkValidity()) return;
        submitBtn.disabled = true;
        submitBtn.setAttribute('aria-busy', 'true');
        submitBtn.textContent = '送信中...';
    });

    // bfcache復帰時にボタンを戻す
    window.addEventListener('pageshow', (e) => {
        if (e.persisted) {
            submitBtn.disabled = false;
            submitBtn.removeAttribute('aria-busy');
            submitBtn.textContent = '登録';
        }
    });

    // パスワード表示切替
    toggle.addEventListener('click', () => {
        const isPwd = pwd.type === 'password';
        pwd.type = isPwd ? 'text' : 'password';
        toggle.textContent = isPwd ? '非表示' : '表示';
    });

    // エラーがある場合、最初のエラー項目へフォーカス
    const firstInvalid = document.querySelector('[aria-invalid="true"]');
    if (firstInvalid) firstInvalid.focus({ preventScroll: false });
});
</script>
@endpush
