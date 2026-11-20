<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; background: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: white; padding: 32px; border-radius: 8px; width: 320px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        h2 { margin-top: 0; text-align: center; }
        input { width: 100%; padding: 10px; margin: 6px 0 14px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: #dc2626; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>