<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Owner</title>
    <style>
        body { background: #e9f5e1; font-family: sans-serif; padding: 40px; }
        .register-box { background: white; max-width: 400px; margin: auto; padding: 20px; border-radius: 10px; border: 1px solid #b8e994; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 6px; border: 1px solid #b8e994; }
        button { background: #4caf50; color: white; border: none; padding: 10px; width: 100%; border-radius: 6px; font-weight: bold; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Register Owner</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <button type="submit">Register</button>
            
            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif
        </form>
    </div>
</body>
</html>
