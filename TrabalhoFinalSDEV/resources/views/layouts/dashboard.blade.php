<!-- resources/views/layouts/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LOGOabrev.png') }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

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
<body class="bg-gray-800 text-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 flex flex-col justify-between shadow-2xl z-10">
            <div>
                <!-- LOGO -->
                <div class="p-8 text-white text-2xl font-bold font-mono tracking-wide">
    <span class="typing-effect">&lt;SNAP/&gt;</span>
</div>

                <!-- Navegação -->
                <nav class="px-6 space-y-4">
                    <a href="{{ url('/dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700 font-mono text-base">DASHBOARD</a>

                    <!-- Gestão Dropdown -->
                    <div x-data="{ open: false }" class="space-y-1">
                        <button @click="open = !open" class="w-full text-left font-mono py-2 px-4 rounded hover:bg-gray-700 flex justify-between items-center text-base">
                            GESTÃO
                            <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4 space-y-1">
                            <a href="{{ route('materiais.home') }}" class="block py-2 px-2  font-mono rounded hover:bg-gray-700 text-base">GESTÃO DE MATERIAL</a>
                            <a href="{{ route('funcionarios.home') }}" class="block py-2 px-2  font-mono rounded hover:bg-gray-700 text-base">GESTÃO DE COLABORADORES</a>
                        </div>
                    </div>

                    <a href="{{ route('servicos.home') }}" class="block py-2 px-4 rounded hover:bg-gray-700 font-mono text-base">EVENTOS</a>
                    <a href="{{ url('/calendario') }}" class="block px-4 py-2 text-white  font-mono hover:bg-gray-700 text-base">
    CALENDÁRIO
</a>
                </nav>
            </div>

            <!-- Logout -->
            <div class="p-6  font-mono">
                <p class="text-center">Olá, {{ Auth::user()->name }}</p>
                <br>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full py-2 px-4 bg-red-950 hover:bg-red-800 font-mono rounded text-center text-lg">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Conteúdo Principal -->
        <main class="flex-1 p-10 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>
</html>
