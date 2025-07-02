<!-- resources/views/layouts/sidebar-funcionario.blade.php -->
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Área do Colaborador</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LOGOabrev.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        @keyframes blink {
            50% { border-color: transparent }
        }
        .typing-effect {
            overflow: hidden;
            border-right: 1px solid white;
            white-space: nowrap;
            width: 0;
            animation:
                typing 2s steps(10, end) forwards,
                blink 0.7s step-end infinite;
        }
    </style>
</head>
<body class="bg-gray-800 text-white font-mono flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen h-screen bg-gray-900 flex flex-col justify-between shadow-2xl z-10 fixed left-0 top-0">
        <div>
            <!-- LOGO -->
            <div class="p-8 text-white text-2xl font-bold font-mono tracking-wide">
                <span class="typing-effect">&lt;SNAP/&gt;</span>
            </div>
        </div>
        <!-- Saudação e Logout sempre no fundo -->
        <div class="p-6 font-mono">
            <p class="text-center mb-4">Olá, {{ Auth::user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full py-2 px-4 bg-red-950 hover:bg-red-800 font-mono rounded text-center text-lg">
                    Logout
                </button>
            </form>
        </div>
    </aside>
    <!-- Conteúdo principal -->
    <main class="flex-1 min-h-screen flex flex-col items-center justify-start py-12 ml-64">
        @yield('content')
    </main>
</body>
</html>
