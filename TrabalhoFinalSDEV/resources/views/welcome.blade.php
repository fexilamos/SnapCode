<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SNAP</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #e2eff1;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 1px solid #444;
            padding: 80px 60px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            background-color: #ffffff20;
        }

        .logo-img {
            width: 300px;
            margin-bottom: 40px;
        }

        .button {
            background-color: #444;
            color: white;
            text-decoration: none;
            padding: 14px 40px;
            font-size: 1.2em;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }

        .button:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/LOGO.png') }}" alt="SNAP Logo" class="logo-img">
        <a href="{{ route('login') }}" class="button">Entrar</a>
    </div>
</body>
</html>
