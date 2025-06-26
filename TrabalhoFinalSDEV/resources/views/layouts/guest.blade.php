<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SnapCode') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            label[for="email"], label[for="password"], label[for="remember_me"] {
                color: #fff !important;
            }
            input[type="email"], input[type="password"] {
                background-color: #111827 !important; /* bg-gray-900 */
                color: #fff !important;
                border: 1px solid #334155 !important; /* border-slate-700 */
            }
        </style>
    </head>
    <body class="font-sans text-white antialiased bg-gray-900">
        <div class="min-h-screen flex flex-col justify-center items-center">
            <div class="mb-8">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-blue-400" />
                </a>
            </div>
            <div class="w-full max-w-md p-10 bg-slate-800 rounded-2xl shadow-2xl border border-slate-700">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
