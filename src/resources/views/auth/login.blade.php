<h1>ログイン</h1>
<form method="POST" action="/login">
    @csrf
    <input name="email" type="email" placeholder="メールアドレス"><br>
    <input name="password" type="password" placeholder="パスワード"><br>
    <button type="submit">ログイン</button>
</form>

<a href="/register">登録</a>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif