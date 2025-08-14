<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            .auth-card {
                background: linear-gradient(145deg, #1f2937, #111111);
                border: 1px solid #374151;
                backdrop-filter: blur(10px);
            }

            .auth-input {
                background: rgba(31, 41, 55, 0.5);
                border: 1px solid #4b5563;
                transition: all 0.3s ease;
            }

            .auth-input:focus {
                border-color: #dc2626;
                box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2);
            }

            .glow-text {
                text-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
            }

            .film-strip {
                background: repeating-linear-gradient(90deg,
                        #2d2d2d 0px,
                        #2d2d2d 20px,
                        #1a1a1a 20px,
                        #1a1a1a 40px);
                height: 8px;
            }
        </style>
    </head>
    <body class="bg-black text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black relative overflow-hidden">
            <!-- Background Effects -->
            <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black"></div>
            
            <div class="relative z-10">
                <a href="/" class="flex items-center space-x-3">
                    <div class="text-4xl font-bold glow-text">🎬 Infoflix</div>
                    <div class="film-strip w-16 hidden sm:block"></div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 auth-card shadow-2xl overflow-hidden sm:rounded-xl relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
