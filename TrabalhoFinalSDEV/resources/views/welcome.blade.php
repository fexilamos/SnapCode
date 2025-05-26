<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SNAP</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1f2937; /* igual ao dashboard */
            font-family: Helvetica, Arial, sans-serif;
            font-weight: bold;
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
}

        .logo-container {
            font-size: 3rem;
            white-space: nowrap;
            margin-bottom: 40px;
            color: white;
        }

        .arrow {
            color: white;
        }

        .snap {
            display: inline-block;
            border-right: 2px solid white;
            color: white;
            animation: blink 0.7s step-end infinite;
                text-shadow: 2px 2px 4px rgba(41, 41, 41, 0.3);

        }

        @keyframes blink {
            from, to { border-color: transparent; }
            50% { border-color: white; }
        }

        .button {
            background-color: #000000;
            color: white;
            text-decoration: none;
            padding: 14px 40px;
            font-size: 1.2em;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <span class="arrow">&lt;</span><span id="snapText" class="snap"></span><span class="arrow">/&gt;</span>
        </div>
        <a href="{{ route('login') }}" class="button">Entrar</a>
    </div>

    <script>
        const text = "SNAP";
        let index = 0;
        const snapText = document.getElementById("snapText");

        function type() {
            if (index < text.length) {
                snapText.textContent += text.charAt(index);
                index++;
                setTimeout(type, 250);
            }
        }

        type();
    </script>
</body>
</html>
