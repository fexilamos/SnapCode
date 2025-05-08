<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>SNAP Logo Animação</title>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .logo-container {
      font-size: 3rem;
      white-space: nowrap;
    }

    .arrow {
      color: #ffffff;
    }

    .snap {
      display: inline-block;
      border-right: 2px solid #ffffff;
      animation: blink 0.7s step-end infinite;
    }

    @keyframes blink {
      from, to { border-color: transparent; }
      50% { border-color: #ffffff; }
    }
  </style>
</head>
<body>
  <div class="logo-container">
    <span class="arrow">&lt;</span><span id="snapText" class="snap"></span><span class="arrow">/&gt;</span>
  </div>

  <script>
    const text = "SNAP";
    const snapEl = document.getElementById("snapText");
    let i = 0;

    function type() {
      if (i < text.length) {
        snapEl.textContent += text.charAt(i);
        i++;
        setTimeout(type, 150);
      }
    }

    // Começa a escrever após pequeno atraso
    setTimeout(type, 500);
  </script>
</body>
</html>
