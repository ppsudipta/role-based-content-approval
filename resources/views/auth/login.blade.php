<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
        }
        .login-box {
            width: 350px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #4CAF50;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>