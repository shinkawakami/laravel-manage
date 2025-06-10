<h1>新規登録</h1>
<form method="POST" action="/register">
    @csrf
    <input name="name" placeholder="名前"><br>
    <input name="email" type="email" placeholder="メールアドレス"><br>
    <input name="password" type="password" placeholder="パスワード"><br>
    <input name="password_confirmation" type="password" placeholder="パスワード確認"><br>
    <button type="submit">登録</button>
</form>

<a href="/login">ログイン</a>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
