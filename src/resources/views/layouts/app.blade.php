<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予定管理アプリ</title>
</head>
<body>
    @auth
        <div>
            ログイン中：{{ Auth::user()->name }}
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    @endauth

    <hr>

    @yield('content')
</body>
</html>